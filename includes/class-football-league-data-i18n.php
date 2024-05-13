<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.linkedin.com/in/syed-ali-haider-a35366194/
 * @since      1.0.0
 *
 * @package    Football_League_Data
 * @subpackage Football_League_Data/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Football_League_Data
 * @subpackage Football_League_Data/includes
 * @author     Syed Ali Haider <haiderhamdani1996@gmail.com>
 */
class Football_League_Data_i18n
{


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain()
	{

		load_plugin_textdomain(
			'football-league-data',
			false,
			dirname(dirname(plugin_basename(__FILE__))) . '/datatv/'
		);
	}
}
