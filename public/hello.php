<?php

/**
 * Generated by the WordPress Option Page generator
 * at http://jeremyhixon.com/wp-tools/option-page/
 */

class FootballLeagueData
{
	private $football_league_data_options;

	public function __construct()
	{
		add_action('admin_menu', array($this, 'football_league_data_add_plugin_page'));
		add_action('admin_init', array($this, 'football_league_data_page_init'));
	}

	public function football_league_data_add_plugin_page()
	{
		add_options_page(
			'Football League Data', // page_title
			'Football League Data', // menu_title
			'manage_options', // capability
			'football-league-data', // menu_slug
			array($this, 'football_league_data_create_admin_page') // function
		);
	}

	public function football_league_data_create_admin_page()
	{
		$this->football_league_data_options = get_option('football_league_data_option_name'); ?>

		<div class="wrap">
			<h2>Football League Data</h2>
			<p>Football League Data - Settings</p>
			<?php settings_errors(); ?>

			<form method="post" action="options.php">
				<?php
				settings_fields('football_league_data_option_group');
				do_settings_sections('football-league-data-admin');
				submit_button();
				?>
			</form>
		</div>
<?php }

	public function football_league_data_page_init()
	{
		register_setting(
			'football_league_data_option_group', // option_group
			'football_league_data_option_name', // option_name
			array($this, 'football_league_data_sanitize') // sanitize_callback
		);

		add_settings_section(
			'football_league_data_setting_section', // id
			'Settings', // title
			array($this, 'football_league_data_section_info'), // callback
			'football-league-data-admin' // page
		);

		add_settings_field(
			'db_host_0', // id
			'DB Host', // title
			array($this, 'db_host_0_callback_data'), // callback
			'football-league-data-admin', // page
			'football_league_data_setting_section' // section
		);

		add_settings_field(
			'db_name_1', // id
			'DB Name', // title
			array($this, 'db_name_1_callback_data'), // callback
			'football-league-data-admin', // page
			'football_league_data_setting_section' // section
		);

		add_settings_field(
			'db_user_2', // id
			'DB User', // title
			array($this, 'db_user_2_callback_data'), // callback
			'football-league-data-admin', // page
			'football_league_data_setting_section' // section
		);

		add_settings_field(
			'db_pass_3', // id
			'DB Pass', // title
			array($this, 'db_pass_3_callback_data'), // callback
			'football-league-data-admin', // page
			'football_league_data_setting_section' // section
		);
	}

	public function football_league_data_sanitize($input)
	{
		$sanitary_values = array();
		if (isset($input['db_host_0'])) {
			$sanitary_values['db_host_0'] = sanitize_text_field($input['db_host_0']);
		}

		if (isset($input['db_name_1'])) {
			$sanitary_values['db_name_1'] = sanitize_text_field($input['db_name_1']);
		}

		if (isset($input['db_user_2'])) {
			$sanitary_values['db_user_2'] = sanitize_text_field($input['db_user_2']);
		}

		if (isset($input['db_pass_3'])) {
			$sanitary_values['db_pass_3'] = sanitize_text_field($input['db_pass_3']);
		}

		return $sanitary_values;
	}

	public function football_league_data_section_info()
	{
	}

	public function db_host_0_callback_data()
	{
		printf(
			'<input class="regular-text" type="text" name="football_league_data_option_name[db_host_0]" id="db_host_0" value="%s">',
			isset($this->football_league_data_options['db_host_0']) ? esc_attr($this->football_league_data_options['db_host_0']) : ''
		);
	}

	public function db_name_1_callback_data()
	{
		printf(
			'<input class="regular-text" type="text" name="football_league_data_option_name[db_name_1]" id="db_name_1" value="%s">',
			isset($this->football_league_data_options['db_name_1']) ? esc_attr($this->football_league_data_options['db_name_1']) : ''
		);
	}

	public function db_user_2_callback_data()
	{
		printf(
			'<input class="regular-text" type="text" name="football_league_data_option_name[db_user_2]" id="db_user_2" value="%s">',
			isset($this->football_league_data_options['db_user_2']) ? esc_attr($this->football_league_data_options['db_user_2']) : ''
		);
	}

	public function db_pass_3_callback_data()
	{
		printf(
			'<input class="regular-text" type="text" name="football_league_data_option_name[db_pass_3]" id="db_pass_3" value="%s">',
			isset($this->football_league_data_options['db_pass_3']) ? esc_attr($this->football_league_data_options['db_pass_3']) : ''
		);
	}
}
if (is_admin())
	$FLDoptions = new FootballLeagueData();

/* 
 * Retrieve this value with:
 * $football_league_data_options = get_option( 'football_league_data_option_name' ); // Array of All Options
 * $db_host_0 = $football_league_data_options['db_host_0']; // DB Host
 * $db_name_1 = $football_league_data_options['db_name_1']; // DB Name
 * $db_user_2 = $football_league_data_options['db_user_2']; // DB User
 * $db_pass_3 = $football_league_data_options['db_pass_3']; // DB Pass
 */
