<?php

/**
 * 
 */
class FootballLeagueDataview
{

    function my_action_javascript($language, $country, $league)
    {
        $football_league_data_options_l = get_option('football_league_data_option_name'); // Array of All Options
        $db_host_l = $football_league_data_options_l['db_host_0']; // DB Host
        $db_name_l = $football_league_data_options_l['db_name_1']; // DB Name
        $db_user_l = $football_league_data_options_l['db_user_2']; // DB User
        $db_pass_l = $football_league_data_options_l['db_pass_3']; // DB Pass

        $connection_l = mysqli_connect($db_host_l, $db_user_l, $db_pass_l, $db_name_l);

        $arr2 = explode(',', $league);
        $json_array = json_encode($arr2);

        if ($connection_l) {

            $connection_l->set_charset("utf8mb4");
            $q_35 = "SELECT * FROM `tv_data_translate` WHERE `en` = 'More' order by `id` DESC limit 1";
            $result_35 = mysqli_query($connection_l, $q_35);
            $array_35 = mysqli_fetch_array($result_35);
            if ($array_35) {
                if ($array_35[$language] != "") {
                    $More = $array_35[$language];
                } else {
                    $More = "More";
                }
            } else {
                $More = "More";
            }

            $q_86 = "SELECT * FROM `tv_data_translate` WHERE `en` = 'Click to see Leagues' order by `id` DESC limit 1";
            $result_86 = mysqli_query($connection_l, $q_86);
            $array_86 = mysqli_fetch_array($result_86);
            if ($array_86) {
                if ($array_86[$language] != "") {
                    $all_leagues = $array_86[$language];
                } else {
                    $all_leagues = "Click To See Leagues";
                }
            } else {
                $all_leagues = "Click To See Leagues";
            }

            $q_10 = "SELECT * FROM `tv_data_translate` WHERE `en` = 'Click to see TV Country' order by `id` DESC limit 1";
            $result_10 = mysqli_query($connection_l, $q_10);
            $array_10 = mysqli_fetch_array($result_10);
            if ($array_10) {
                if ($array_10[$language] != "") {
                    $all_countries = $array_10[$language];
                } else {
                    $all_countries = "Click to see TV Country";
                }
            } else {
                $all_countries = "Click to see TV Country";
            }
        }
        $x =  '<script type="text/javascript">
                    function ajaxCall(type = 0,param) 
                    { 
                        var leagues = ' . $json_array . ';
                        var country = String(`' . $country . '`);
                        var lang_field= String(`' . $all_leagues . '`);
                        var url = new URL(window.location.href);
                        var date_url = url.searchParams.get("date");

                        var d = new Date(),
                            month = "" + (d.getMonth() + 1),
                            day = "" + d.getDate(),
                            year = d.getFullYear();
                            if (month.length < 2) 
                                month = "0" + month;
                            if (day.length < 2) 
                                day = "0" + day;
                            var date_1 = [year, month, day].join("-");

                        var currentDate = new Date(new Date().getTime() + 24 * 60 * 60 * 1000);
                            var day1 = currentDate.getDate();
                            var month1 = currentDate.getMonth() + 1;
                            var year1 = currentDate.getFullYear();
                            if (month1 < 10) 
                                month1 = "0" + month1
                            if (day1.length < 2) 
                                day1 = "0" + day1
                            var date_2 = [year1, month1, day1].join("-");
                        
                            if(date_url == null)
                            {
                                date_url = "TODAY";
                            }

                        var buttonsArrr = document.querySelectorAll(".dater");
                        buttonsArrr.forEach((items)=>{
                           
                            items.closest("td.date-selector_new").classList.remove("active");                            }
                        );
                        
                        var buttonsArr = document.querySelectorAll(".dater");
                        buttonsArr.forEach((item)=>{
                            if (item.name == date_url)
                            {
                                item.closest("td.date-selector_new").classList.add("active");                            }
                        });

                        if(type == 0 || type == 1 || type == 12 || type == 2 || type == 3)
                        {
                            document.getElementById("3row").innerHTML = "";
                            document.getElementById("33row").innerHTML = "";
                            $("#loader").show();
                            $("#unknown").hide();
                        }

                        if(type == 1 || type == 0 || type == 12)
                        {
                            if(type == 1 || type == 12)
                            {
                                const cars = [];
                                var l = 0;
                                document.querySelectorAll("[name^=' . "'teamcountry'    " . ']").forEach(function(node) {
                                    cars[l] = node.options[node.selectedIndex].value;
                                l++;
                                });

                                
                                    country = cars[0];
                                    if(country == "")
                                    {
                                    country = "none";
                                    }
                            }
                            if(type == 0)
                            {
                                if(country == "")
                                {
                                    country = "none";
                                }
                            }

                            if(type == 1 )
                            {
                                document.getElementById("teamleague").selectedIndex = 0;
                            }

                            value_1 = document.querySelectorAll("[name=' . "'teamname'" . ']")[0].value;
                            value_2 = document.querySelectorAll("[name=' . "'teamname'" . ']")[1].value;
                            if(value_1 == "")
                            {
                                team = value_2;
                                if(team == "")
                                {
                                    team = "none";
                                }
                            }
                            else{
                                team = value_1;
                                if(team == "")
                                {
                                    team = "none";
                                }
                            }
                           

                            if(date_url != null)
                            {
                                if(date_url == "TODAY"){
                                    var date = date_1;
									document.getElementById("date_live").innerHTML = date;
                                }
                                if(date_url == "TOMORROW"){
                                    var date = date_2;
									document.getElementById("date_live").innerHTML = date;
                                }
                            }
                        }
                        else if( type == 2)
                        {
                            document.getElementById("teamcountry-desk").innerHTML = "' . $all_countries . '";
                            var check1 = document.getElementById("teamcountry").selectedIndex = 0;
                            var check4 = document.getElementById("teamleague").selectedIndex = 0;
                            // check.value = "none";
                            document.getElementById("teamname").value = "";
                            country = "none";
                            team = "none";
                            window.history.replaceState(null,null,"?date=TODAY");
                            var date = date_1;
                            document.getElementsByClassName("active")[0].classList.remove("active");
                            document.getElementById("td_4").classList.add("active");
                        }

                        if(type == 1 && (param != 0))
                        {
                            country =  param;
                        }

                        if(type == 3)
                        {
                            
                            var check1 = document.getElementById("teamcountry").selectedIndex = 0;
                            document.getElementById("teamname").value = "";
                            country = "none";
                            team = "none";
                            if(date_url != null)
                            {
                                if(date_url == "TODAY"){
                                    var date = date_1;
									document.getElementById("date_live").innerHTML = date;
                                }
                                if(date_url == "TOMORROW"){
                                    var date = date_2;
									document.getElementById("date_live").innerHTML = date;
                                }
                            }

                            var leagues = [];
                            const countrys = [];
                            var h = 0;
                            document.querySelectorAll("[name^=' . "'teamleague'    " . ']").forEach(function(nodess) {
                                var da = nodess.options[nodess.selectedIndex].value;
                                const myArray = da.split(" > ");
                                
                                countrys[h] =  myArray[0];
                                leagues[h] =  myArray[1];
                                h++;
                            });
                            
                                league = leagues[0];
                                l_country = countrys[0];
                                    if(league == "")
                                    {
                                        league = "none";
                                    }
                                    if(l_country == "")
                                    {
                                        l_country = "none";
                                    }

                            if(param != 0)
                            {
                                    const count_league = param.split(" _ ");
                                        l_country =  count_league[0];
                                        league =  count_league[1];
                            }else if(league != "none" && l_country != "none")
                            {

                            }
                            else{
                                l_country =  "none";
                                league =  "none";
                            }

                            
                        }else{
                            league = "none";
                            l_country = "none";
                        }


                        var ajaxscript = {
                            ajax_url: "' . admin_url("admin-ajax.php") . '"
                        }

                        var data = {
                            "action": "my_action",
                            "country": country,
                            "team": team,
                            "date": date,
                            "league": league,
                            "l_country": l_country
                        };
                        JSON.stringify(data);
                        jQuery.post(ajaxscript.ajax_url, data, function(response) 
                        {
                            var res = response;
                            // console.log(response);
                            if(res != "")
                            {
                            var jsons = $.parseJSON(response);
                            var length = jsons.league.length;
                            }
                            
                            if(res != "" && length > 0)
                            {
                                var json = $.parseJSON(response);
                                for(j = 0; j < length; j++) 
                                {
                                    for(i = 0; i < length-1; i++)
                                    {
                                        if(json.league[i].league.time > json.league[i+1].league.time) 
                                        {
                                            temp = json.league[i+1];
                                            json.league[i+1]=json.league[i];
                                            json.league[i]=temp;
                                        }       
                                    }
                                }

                                var array = new Array();
                                var second = new Array();
                                var jdr= json;
                                var jkr= $.parseJSON(response);
                                jkr.leagues = "";
                                for(j = 0; j < leagues.length; j++) 
                                {
                                    for(i = 0; i < length; i++) 
                                    {
                                        if(jdr.league[i].league.league_id == leagues[j])
                                        {
                                            array.push(jdr.league[i]);
                                        }
                                        else{
                                            
                                        }

                                    }
                                }

                                for(i = 0; i < length; i++) 
                                    {
                                        var g = 0;
                                        for(j = 0; j < leagues.length; j++) 
                                        {   
                                            if(jdr.league[i].league.league_id == leagues[j])
                                            {
                                                g ++;
                                            }
                                        }
                                        if(g == 0)
                                        {
                                            second.push(jdr.league[i]);
                                        }
                                    }

                                jkr.league = array;
                                
                                for( l = 0; l<second.length; l++)
                                {
                                    jkr.league.push(second[l]);
                                }

                                json = jkr;

                                    var i = 1;
                            
                                var leaguetvDom = "";
                                var counter = 9850343080+i;
                                
                                var l = 0;
                                document.querySelectorAll("[name^=' . "'teamleague'    " . ']").forEach(function(nodes) {
                                    
                                    // nodes.find("option").not(":first").remove();

                                    while (nodes.options.length > 0) {
                                        nodes.remove(0);
                                    }
                                    
                                    var f = 1;
                                    document.getElementById("child-div").innerHTML = "";
                                    json.allleagues[0].forEach((leaguesData)=>
                                        {
                                            const coun_league = leaguesData.split(" > ");
                                            l_country_1 =  coun_league[0];
                                            league_1 =  coun_league[1];
                                            var value_t  = l_country_1+" _ "+league_1;
                                            var text = l_country_1+"-"+league_1;

                                            var text_2 =  coun_league[2];
                                            const id_league = "id_"+f;
                                           
                                            var img = "<img src= "+`"`+""+text_2+""+`"`+"  width="+`"`+"40px"+`"`+" height="+`"`+"40px"+`"`+" alt="+`"`+"league"+`"`+"  >";
                                            var label = "<label class="+`"`+"btn btn-light fl-label"+`"`+" id= "+`"`+""+id_league+""+`"`+" name= "+`"`+""+value_t+""+`"`+" onclick="+`"`+"setleague1(this)"+`"`+" >"+img+text+"</label>";
                                            
                                            document.getElementById("child-div").innerHTML += label;
                                            f++;
                                        });

                                    const newOption1 = document.createElement("option");
                                    const optionText1 = document.createTextNode(lang_field);
                                    newOption1.appendChild(optionText1);
                                    newOption1.setAttribute("value","");
                                    nodes.add(newOption1);

                                    var k = 0;
                                        json.allleagues[0].forEach((leaguesData)=>
                                        {
                                            //  var countryy = json.countries[0][k];
                                            //   var da = countryy+" > "+leaguesData;

                                            const co_league = leaguesData.split(" > ");
                                            l_coun_1 =  co_league[0];
                                            leage_1 =  co_league[1];
                                            var da = l_coun_1+" > "+leage_1;
                                            const newOption = document.createElement("option");
                                            const optionText = document.createTextNode(da);
                                            // set option text
                                            newOption.appendChild(optionText);
                                            // and option value
                                            newOption.setAttribute("value",leaguesData);
                                             nodes.add(newOption);
                                             k++;
                                        });
                                        l++;
                                });
                                json.league.forEach((leagueData)=>
                                {
                                    leaguetvDom += `
                                    <table class="parent-table-all-data novisible">
                                        <tbody>`;
                                            leaguetvDom += `
                                            <tr class="table-head-row-new shower">
                                                <th class="larg-width-the-new" style="width: 40%;">
                                                    <div class="match-head-new">
                                                        <img title="${leagueData.league.leaguecountry}" src="${leagueData.league.leaguelogo}" loading="lazy">
                                                        <span class="lg-name-country-new">${leagueData.league.leaguecountry} - ${leagueData.league.leaguename}</span>
                                                    </div>
                                                </th>
                                                <th class="text-center small-width-th hide-on-mobile-new">1</th>
                                                <th class="text-center small-width-th hide-on-mobile-new">2</th>
                                                <th class="text-center small-width-th hide-on-mobile-new">3</th>
                                                <th class="text-center small-width-th hide-on-mobile-new">4</th>
                                            </tr>
                                            <tr class="table-data-infos-new shower">
                                                <td class="tv-larg-data" style="width: 40%;">
                                                    <div class="match-info-inner-new tv-info-iiner">
                                                        <span class="match-time-new">${leagueData.league.time}</span>
                                                        <a href="https://tipy1x2.com/api-football/standings_display.php?league=909&amp;season=2022" class="btn" target="_blank" rel="noopener">
                                                        <span class="info-standings-new">
                                                        <img title="${leagueData.league.teamhomelogotitle}" src="${leagueData.league.teamhomelogo}" loading="lazy"> 
                                                        </span>
                                                        </a>
                                                        <span class="home-team-new">
                                                            <span class="wordbreak-css-new tv-wordbreak">${leagueData.league.teamhomename}</span>
                                                            <span class="home-t-point-new">${leagueData.league.teamhomegoal}</span>
                                                        </span>
                                                        <span class="away-team-new desktop-new">
                                                            <span class="away-t-point-new">${leagueData.league.teamawaygoal}</span>
                                                            <span class="wordbreak-css-new">${leagueData.league.teamawayname}</span>
                                                        </span>
                                                        <a href="/game-predictions-tips/colorado-rapids-ii-vs-houston-dynamo-fc-ii-/?fixtureid=854283" target="_blank">
                                                            <span class="td-inner-new tounament-popup-icon" >
                                                            <img title="${leagueData.league.teamawaylogotitle}" src="${leagueData.league.teamawaylogo}" loading="lazy"> 
                                                            </span>
                                                        </a>
                                                    </div>
                                                </td>
                                                <!-- Tv Channel Desktop Start-->`;
                                                var totalMedia = leagueData.channels.length;
                                                if(totalMedia >= 1)
                                                {
                                                    var channeltitle_1 =  leagueData.channels[0].channeltitle;
                                                    var channellogo_1 =  leagueData.channels[0].channellogo;
                                                    var channelname_1 =  leagueData.channels[0].channelname;
                                                    leaguetvDom += `<td class="hide-on-mobile-new tv-small-data-new">
                                                                        <span class="td-inner-new single-tv-new" >
                                                                            <img title="${channeltitle_1} - ${channelname_1}" src="${channellogo_1}" loading="lazy">
                                                                        </span>
                                                                    </td>`;
                                                }
                                                else
                                                {
                                                    leaguetvDom += `<td class="hide-on-mobile-new tv-small-data-new">
                                                                        <span class="td-inner-new single-tv-new" >-</span>
                                                                    </td>`;
                                                }
                                                if(totalMedia >= 2)
                                                {
                                                    var channeltitle_2 = leagueData.channels[1].channeltitle;
                                                    var channellogo_2 =  leagueData.channels[1].channellogo;
                                                    var channelname_2 =  leagueData.channels[1].channelname;
                                                    leaguetvDom += `<td class="hide-on-mobile-new tv-small-data-new">
                                                                        <span class="td-inner-new single-tv-new" >
                                                                            <img title="${channeltitle_2} - ${channelname_2}" src="${channellogo_2}" loading="lazy">
                                                                        </span>
                                                                    </td>`;
                                                }
                                                else
                                                {
                                                    leaguetvDom += `<td class="hide-on-mobile-new tv-small-data-new">
                                                                        <span class="td-inner-new single-tv-new" >-</span>
                                                                    </td>`;
                                                }
                                                if(totalMedia >= 3)
                                                {
                                                    var channeltitle_3 =  leagueData.channels[2].channeltitle;
                                                    var channellogo_3 = leagueData.channels[2].channellogo;
                                                    var channelname_3 =  leagueData.channels[2].channelname;
                                                    leaguetvDom += `<td class="hide-on-mobile-new tv-small-data-new">
                                                                        <span class="td-inner-new single-tv-new" >
                                                                            <img title="${channeltitle_3} - ${channelname_3}" src="${channellogo_3}" loading="lazy">
                                                                        </span>
                                                                    </td>`;
                                                }
                                                else
                                                {
                                                    leaguetvDom += `<td class="hide-on-mobile-new tv-small-data-new">
                                                                        <span class="td-inner-new single-tv-new" >-</span>
                                                                    </td>`;
                                                }
                                                if(totalMedia <= 4)
                                                {
                                                    if(totalMedia == 4)
                                                    {
                                                        var channeltitle_4 =  leagueData.channels[3].channeltitle;
                                                        var channellogo_4 = leagueData.channels[3].channellogo;
                                                        var channelname_4 =  leagueData.channels[3].channelname;
                                                        leaguetvDom += `<td class="hide-on-mobile-new tv-small-data-new">
                                                                            <span class="td-inner-new single-tv-new" >
                                                                                <img title="${channeltitle_4} - ${channelname_4}" src="${channellogo_4}" loading="lazy">
                                                                            </span>
                                                                        </td>`;
                                                        
                                                    }
                                                    else{
                                                        leaguetvDom += `<td class="hide-on-mobile-new tv-small-data-new">
                                                                            <span class="td-inner-new single-tv-new" >-</span>
                                                                        </td>`;
                                                    }
                                                }
                                                else
                                                {
                                                    var k = 1;
                                                    leaguetvDom += `
                                                    <td class="hide-on-mobile-new tv-small-data-new"><span class="td-inner-new single-tv-new" data-tv-id="${i}" onclick="myFunction(${i})">+' . $More . '</span>
                                                        <div class="extra-tv-logos-new" id="${i}">
                                                            <span class="tv-logo-closer-new" id="close" onclick="myFunction2(${i})">⛌</span>
                                                            <div class="extra-tv-logos-inner-new">
                                                                <center><span style="color: white; font-size:20px; font-family: Cairo,sans-serif !important; text-decoration: underline;">${leagueData.league.leaguecountry} - ${leagueData.league.leaguename}</span>
                                                                <br> <span style="color: white; font-size:20px; font-family: Cairo,sans-serif !important; ">${leagueData.league.teamhomename} VS ${leagueData.league.teamawayname}</span> </center>`;
                                                                leagueData.channels.forEach((ChannelData)=>{
                                                                    if(k < 4 )
                                                                    {
                                                                    }
                                                                    else
                                                                    {
                                                                        leaguetvDom += `<img title="${ChannelData.channeltitle} - ${ChannelData.channelname}" src="${ChannelData.channellogo}" loading="lazy">`;
                                                                    }
                                                                    k = k+1;
                                                                });
                                                                leaguetvDom += `
                                                            </div>
                                                        </div>
                                                    </td>`;
                                                }
                                                leaguetvDom += ` <!-- Tv Channel desktop-new End-->
                                            </tr>
                                            <!-- Tv Channel Desktop End-->
                                            <!-- Mobile Screen Table Start-->
                                            <tr class="table-head-row-new hideer" style="display: none; font-family: Cairo,sans-serif !important;">
                                                <th class="small-width-th" style="width: 40%;">
                                                    <div class="match-head-new">
                                                        <img title="${leagueData.league.leaguecountry}" src="${leagueData.league.leaguelogo}" loading="lazy">
                                                        <span class="lg-name-country-new">${leagueData.league.leaguecountry} - ${leagueData.league.leaguename}</span>
                                                    </div>
                                                </th>
                                            </tr>
                                            <tr class="hideer" style="display: none; font-family: Cairo,sans-serif !important;">
                                                <td>
                                                    <span class="match-time-sm" style="font-family: Cairo,sans-serif !important;">${leagueData.league.time}</span>
                                                </td>
                                            </tr>
                                            <tr class="hideer" style="display: none; font-family: Cairo,sans-serif !important;">
                                                <td>
                                                    <span class="wordbreak-css-sm tv-wordbreak-sm" style="font-family: Cairo,sans-serif !important;">${leagueData.league.teamhomename}</span>
                                                    <span class="away-t-point-sm" style="font-family: Cairo,sans-serif !important;">${leagueData.league.teamhomegoal}</span>
                                                    <span class="info-standings-new">
                                                        <img title="${leagueData.league.teamhomelogotitle}" src="${leagueData.league.teamhomelogo}" loading="lazy"> 
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr class="hideer" style="display: none; font-family: Cairo,sans-serif !important;">
                                                <td>
                                                    <span class="wordbreak-css-sm" style="font-family: Cairo,sans-serif !important;">${leagueData.league.teamawayname}</span>
                                                    <span class="away-t-point-sm"style="font-family: Cairo,sans-serif !important;">${leagueData.league.teamawaygoal}</span>
                                                    <span class="info-standings-new">
                                                    <img title="${leagueData.league.teamawaylogotitle}" src="${leagueData.league.teamawaylogo}" loading="lazy"> 
                                                    </span>
                                                </td>
                                            </tr>`;
                                            leaguetvDom += `<!-- Tv Channel Mobile Start-->
                                            <tr class="table-head-row-new hideer" style="display: none; font-family: Cairo,sans-serif !important;">
                                                <th class="small-width-th" style="background-color: black!important;">
                                                    <div class="match-head-new">
                                                        <span class="sm-name-country" onclick="myFunction_sm(${counter})">Click To See Tv Channel</span>
                                                        <div class="extra-tv-logos-sm" id="${counter}">
                                                            <span class="tv-logo-closer-new" id="close" onclick="myFunction2_sm(${counter})">⛌</span>
                                                            <div class="extra-tv-logos-inner-sm">
                                                                <center><span style="color: white;">${leagueData.league.leaguecountry} - ${leagueData.league.leaguename}</span>
                                                                <br> <span style="color: white;">${leagueData.league.teamhomename} VS ${leagueData.league.teamawayname}</span> </center>`;
                                                                leagueData.channels.forEach((ChannelData)=>{
                                                leaguetvDom += `<img title="${ChannelData.channeltitle} - ${ChannelData.channelname}" src="${ChannelData.channellogo}" loading="lazy">`;
                                                                });
                                                leaguetvDom += `</div>
                                                        </div>
                                                    </div>
                                                </th>
                                            </tr>
                                            <!-- Tv Channel Mobile End-->
                                            <!-- Mobile Screen Table End-->
                                            `;
                                            i++;
                                            counter++;
                                        leaguetvDom += 
                                        `</tbody>
                                    </table>`;
                                });
                                           
                                
                                    $("#unknown").hide;
                                    $("#3row").html(leaguetvDom); 
                                    $("#loader").hide();
                            }else{
                                    leaguetvDom = "";
                                    leaguetvDom += `<div class="match-info-inner-new tv-info-iiner" id="unknown" style = "background: #ddd; font-size:20px; font-weight: 500;"><center> No Data For This Filter Search</center></div>
                                    `;
                                    $("#loader").hide();
                                    $("#3row").html(leaguetvDom); 
                                    $("#33row").html(""); 
                            }
                        });
                    }
                </script>
                <script>
                function show()
                {

                    var y = document.getElementById("child-div-country");
                    if(y.style.display == "none")
                    {
                    }
                    else{
                        document.getElementById("child-div-country").style.display = "none";
                    }

                    var x = document.getElementById("child-div");
                    if(x.style.display == "none")
                    {
                        document.getElementById("child-div").style.display = "flex";
                        
                    }
                    else{
                        document.getElementById("child-div").style.display = "none";
                    }
                    
                }
                function show_country()
                {

                    var y = document.getElementById("child-div");
                    if(y.style.display == "none")
                    {
                    }
                    else{
                        document.getElementById("child-div").style.display = "none";
                    }

                    var x = document.getElementById("child-div-country");
                    if(x.style.display == "none")
                    {
                        document.getElementById("child-div-country").style.display = "flex";
                        
                    }
                    else{
                        document.getElementById("child-div-country").style.display = "none";
                    }
                    
                }
                function setcountry1(element)
                {
                        ajaxCall(1,0);
                }
                function setcountry(element)
                {
                        var id_2  = element.id;
                        var name_2 =  document.getElementById(id_2).getAttribute("name");
                        document.getElementById("teamcountry-desk").innerHTML = name_2;
                        document.getElementById("child-div-country").style.display="none";
                        ajaxCall(1,name_2);
                }
                function setleague(element)
                {
                        ajaxCall(3,0);
                }
                function setleague1(element)
                {

                    var id  = element.id;
                    var name =  document.getElementById(id).getAttribute("name");
                    document.getElementById("teamcountry-desk").innerHTML = "' . $all_countries . '";
                    document.getElementById("child-div").style.display="none";
                    ajaxCall(3,name);
                }
                </script>
                <script>
                function seturl1(element)
                {
                        var value_1 = "TODAY";
                        window.history.replaceState(null,null,"?date="+value_1+"");
                        ajaxCall(0,0);
                }
                </script>

                <script>
                function seturl2(element)
                {
                        var value_2 = "TOMORROW";
                        window.history.replaceState(null,null,"?date="+value_2+"");
                        ajaxCall(0,0);
                }
                </script>

                <script>
                function seturl3(element)
                {
                        var value_3 = "TODAY";
                        window.history.replaceState(null,null,"?date="+value_3+"");
                        ajaxCall(0,0);
                }
                </script>

                <script>
                function seturl4(element)
                {
                        var value_4 = "TOMORROW";
                        window.history.replaceState(null,null,"?date="+value_4+"");
                        ajaxCall(0,0);
                }
                </script>
                
                ';
        return $x;
    }
    // json.league[0].league.leaguecountry
    // json.league[0].channels[0][0].channeltitle
    function views_2($language, $country, $image)
    {
        $football_league_data_options = get_option('football_league_data_option_name'); // Array of All Options
        $date_66 = date('d-m-y');
        $db_host_0 = $football_league_data_options['db_host_0']; // DB Host
        $db_name_1 = $football_league_data_options['db_name_1']; // DB Name
        $db_user_2 = $football_league_data_options['db_user_2']; // DB User
        $db_pass_3 = $football_league_data_options['db_pass_3']; // DB Pass

        $connection = mysqli_connect($db_host_0, $db_user_2, $db_pass_3, $db_name_1);

        if ($connection) {

            $connection->set_charset("utf8mb4");
            $q = "SELECT * FROM `tv_data_translate` WHERE `en` = 'Navigation' order by `id` DESC limit 1";
            $result = mysqli_query($connection, $q);
            $array = mysqli_fetch_array($result);
            if ($array) {
                if ($array[$language] != "") {
                    $navigation = $array[$language];
                } else {
                    $navigation = "Navigation";
                }
            } else {
                $navigation = "Navigation";
            }

            $q_1 = "SELECT * FROM `tv_data_translate` WHERE `en` = 'LIVE FOOTBALL ON TV' order by `id` DESC limit 1";
            $result_1 = mysqli_query($connection, $q_1);
            $array_1 = mysqli_fetch_array($result_1);
            if ($array_1) {
                if ($array_1[$language] != "") {
                    $live_tv = $array_1[$language];
                } else {
                    $live_tv = "LIVE FOOTBALL ON TV";
                }
            } else {
                $live_tv = "LIVE FOOTBALL ON TV";
            }

            $q_4 = "SELECT * FROM `tv_data_translate` WHERE `en` = 'Search Team' order by `id` DESC limit 1";
            $result_4 = mysqli_query($connection, $q_4);
            $array_4 = mysqli_fetch_array($result_4);
            if ($array_4) {
                if ($array_4[$language] != "") {
                    $search_team = $array_4[$language];
                } else {
                    $search_team = "Search Team";
                }
            } else {
                $search_team = "Search Team";
            }

            $q_25 = "SELECT * FROM `tv_data_translate` WHERE `en` = 'TODAY' order by `id` DESC limit 1";
            $result_25 = mysqli_query($connection, $q_25);
            $array_25 = mysqli_fetch_array($result_25);
            if ($array_25) {
                if ($array_25[$language] != "") {
                    $TODAY = $array_25[$language];
                } else {
                    $TODAY = "TODAY";
                }
            } else {
                $TODAY = "TODAY";
            }

            $q_15 = "SELECT * FROM `tv_data_translate` WHERE `en` = 'TOMORROW' order by `id` DESC limit 1";
            $result_15 = mysqli_query($connection, $q_15);
            $array_15 = mysqli_fetch_array($result_15);
            if ($array_15) {
                if ($array_15[$language] != "") {
                    $TOMORROW = $array_15[$language];
                } else {
                    $TOMORROW = "TOMORROW";
                }
            } else {
                $TOMORROW = "TOMORROW";
            }


            $q_55 = "SELECT * FROM `tv_data_translate` WHERE `en` = 'All Matches on TV' order by `id` DESC limit 1";
            $result_55 = mysqli_query($connection, $q_55);
            $array_55 = mysqli_fetch_array($result_55);
            if ($array_55) {
                if ($array_55[$language] != "") {
                    $headline = $array_55[$language];
                } else {
                    $headline = "All Matches on TV";
                }
            } else {
                $headline = "All Matches on TV";
            }


            $q_6 = "SELECT * FROM `tv_data_translate` WHERE `en` = 'Search by Team Name' order by `id` DESC limit 1";
            $result_6 = mysqli_query($connection, $q_6);
            $array_6 = mysqli_fetch_array($result_6);
            if ($array_6) {
                if ($array_6[$language] != "") {
                    $search_team_name = $array_6[$language];
                } else {
                    $search_team_name = "Search by Team Name";
                }
            } else {
                $search_team_name = "Search by Team Name";
            }

            $q_7 = "SELECT * FROM `tv_data_translate` WHERE `en` = 'Filter' order by `id` DESC limit 1";
            $result_7 = mysqli_query($connection, $q_7);
            $array_7 = mysqli_fetch_array($result_7);
            if ($array_7) {
                if ($array_7[$language] != "") {
                    $filter = $array_7[$language];
                } else {
                    $filter = "Filter";
                }
            } else {
                $filter = "Filter";
            }

            $q_77 = "SELECT * FROM `tv_data_translate` WHERE `en` = 'Days' order by `id` DESC limit 1";
            $result_77 = mysqli_query($connection, $q_77);
            $array_77 = mysqli_fetch_array($result_77);
            if ($array_77) {
                if ($array_77[$language] != "") {
                    $Days = $array_77[$language];
                } else {
                    $Days = "Days";
                }
            } else {
                $Days = "Days";
            }

            $q_8 = "SELECT * FROM `tv_data_translate` WHERE `en` = 'Reset' order by `id` DESC limit 1";
            $result_8 = mysqli_query($connection, $q_8);
            $array_8 = mysqli_fetch_array($result_8);
            if ($array_8) {
                if ($array_8[$language] != "") {
                    $reset = $array_8[$language];
                } else {
                    $reset = "Reset";
                }
            } else {
                $reset = "Reset";
            }

            $q_10 = "SELECT * FROM `tv_data_translate` WHERE `en` = 'Click to see TV Country' order by `id` DESC limit 1";
            $result_10 = mysqli_query($connection, $q_10);
            $array_10 = mysqli_fetch_array($result_10);
            if ($array_10) {
                if ($array_10[$language] != "") {
                    $all_countries = $array_10[$language];
                } else {
                    $all_countries = "Click to see TV Country";
                }
            } else {
                $all_countries = "Click to see TV Country";
            }

            $date_98 = $_GET['date'];
            if ($date_98 == "TODAY") {
                $date_98 = date("Y-m-d");
            } else if ($date_98 == "TOMORROW") {
                $date_98 = date("Y-m-d", " +1 day");
            } else {
                $date_98 = date("Y-m-d");
            }
            $date_98 = "2022-10-20";
            $q_98 = "SELECT `strCountry` FROM `tv_thesportsdb` WHERE `dateEvent` = '$date_98' GROUP BY `strCountry` ORDER BY `idEvent` ASC";
            $result_98 = mysqli_query($connection, $q_98);
            $num_rows_98 = mysqli_num_rows($result_98);
            if ($num_rows_98 > 0) {
                $countryArray = array();
                $countryflag = array();
                for ($i = 0; $i < $num_rows_98; $i++) {
                    mysqli_data_seek($result_98, $i);
                    $row = mysqli_fetch_row($result_98);
                    $countryArray[$i][0] = $row[0];

                    $flag = "";
                    $q_55 = "SELECT `country_flag` FROM `leagues` WHERE `country_name` = '$row[0]' limit 1;";
                    $result_55 = mysqli_query($connection, $q_55);
                    $array_55 = mysqli_fetch_array($result_55);
                    $flag = $array_55['country_flag'];
                    $countryArray[$i][1] = $flag;
                }
                sort($countryArray);
            } else {
                $countryArray = NULL;
            }

            $q_99 = "SELECT `fixture_id`, `league_name`,`league_country`, `league_logo` FROM `fixtures` WHERE `date` = '$date_98' GROUP BY `league_name` ORDER BY 'league_country' ASC";
            $result_99 = mysqli_query($connection, $q_99);
            $num_rows_99 = mysqli_num_rows($result_99);
            if ($num_rows_99 > 0) {
                $leagueArray = array();
                $leaguecountry = array();
                $leagueflag = array();
                $k = 0;
                for ($f = 0; $f < $num_rows_99; $f++) {
                    mysqli_data_seek($result_99, $f);
                    $row_99 = mysqli_fetch_row($result_99);

                    $q_00 = "SELECT `idEvent` FROM `fixtures_thesportsdb` WHERE `idAPIfootball` =  '$row_99[0]' ORDER BY `idEvent` ASC limit 1";
                    $result_1 = mysqli_query($connection, $q_00);
                    $array_1 = mysqli_fetch_array($result_1);
                    if ($array_1 == NULL) {
                    } else {
                        $idEvent = $array_1['idEvent'];

                        $q_11 = "SELECT `idEvent` FROM `tv_thesportsdb` WHERE `idEvent` =  '$idEvent' ORDER BY `idEvent` ASC limit 1";
                        $result_11 = mysqli_query($connection, $q_11);
                        $array_11 = mysqli_fetch_array($result_11);
                        if ($array_11 == NULL) {
                        } else {
                            $idEvent_1 = $array_11['idEvent'];

                            if ($idEvent_1 != "" || $idEvent_1 != 0) {
                                $leagueArray[$k] = $row_99[1];
                                $leaguecountry[$k] = $row_99[2];
                                $leagueflag[$k] = $row_99[3];
                                $k++;
                            }
                        }
                    }
                }
            } else {
                $leagueArray = NULL;
                $leaguecountry = NULL;
            }

            $q_86 = "SELECT * FROM `tv_data_translate` WHERE `en` = 'Click to see Leagues' order by `id` DESC limit 1";
            $result_86 = mysqli_query($connection, $q_86);
            $array_86 = mysqli_fetch_array($result_86);
            if ($array_86) {
                if ($array_86[$language] != "") {
                    $all_leagues = $array_86[$language];
                } else {
                    $all_leagues = "Click to see Leagues";
                }
            } else {
                $all_leagues = "Click to see Leagues";
            }


            $y = '  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
                    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                    <link href="https://fonts.googleapis.com/css?family=Big Shoulders Display" rel="stylesheet">
                    <link href="https://fonts.googleapis.com/css?family=Rakkas"rel="stylesheet">
                    <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">
                    <style>
                        .fl-dropdown{
                            position: static;
                            display: inline-block;
                            overflow: visible;
                            padding: 10px 15px 10px 15px;
                            border-radius: 0;
                            border: none;
                            font-family: "Cairo",sans-serif !important;
                            font-weight: 400;
                            font-size: 1rem;
                            line-height: 1.5;
                            color: #666;
                            background: #fafafa;
                            cursor: context-menu;
                            user-select: none;
                        }
                        .fl-dropdown-menu{
                            position: absolute;
                            display: none;
                            left: -228px;
                            top: 83px;
                            width: 1198px !important;
                            flex-direction: row;
                            flex-wrap: wrap;
                            border: 0.5px solid #bccfe0;;
                            padding: 2px;
                            width: 100%;
                            z-index: 1;
                        }
                        .fl-label{
                            flex: 1;
                            padding: 2%;
                            padding-bottom: .5%;
                            border: 0.5px dotted #444;
                            flex-basis: 20%;
                            border-left: 0px;
                            border-right: 0px;
                            border-top: 0px;
                            margin: 0px 5px 0px 5px;
                            text-align: left !important;
                            
                            
                        }
                        .fl-label img{
                            
                        }
                        .fl-dropdown-country{
                            position: static;
                            display: inline-block;
                            overflow: visible;
                            padding: 10px 15px 10px 15px;
                            border-radius: 0;
                            border: none;
                            font-family: "Cairo",sans-serif !important;
                            font-weight: 400;
                            font-size: 1rem;
                            line-height: 1.5;
                            color: #666;
                            background: #fafafa;
                            cursor: context-menu;
                        }

                        .fl-dropdown-menu-country{
                            position: absolute;
                            display: none;
                            left: 0px;
                            top: 83px;
                            width: 1198px !important;
                            flex-direction: row;
                            flex-wrap: wrap;
                            border: 0.5px solid #bccfe0;;
                            padding: 2px;
                            width: 100%;
                            z-index: 1;
                        }

                        .fl-label-country{
                            font-family: Cairo, sans-serif !important;
                            flex: 1;
                            padding: 1%;
                            padding-bottom: .5%;
                            border: 0.5px dotted #444;
                            flex-basis: 20%;
                            border-left: 0px;
                            border-right: 0px;
                            border-top: 0px;
                            margin: 0px 5px 0px 5px;
                            text-align: left !important;
                            
                        }

                        
                        .cont {
                            max-width: 1230px;
                            font-family: "Big Shoulders Display", display !important;
                            margin-left: -8%;
                        }
						h2.gb-headline-9ceee965 {
                            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji" !important;
                        }

                        h2.gb-headline-9c018eb4 {
                            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji" !important;
                        }
                        .primary-menu {
                        font-family: Ubuntu, sans-serif !important;
                        font-size: 16px !important;
                        font-weight: 400 !important;
                        line-height: 1.5 !important;
                        }
                        
                        .headings {
                            
                            color: #000000 !important;
                            font-weight: 600 !important;
                            font-family: "Big Shoulders Display" !important;
                            line-height: 1.1 !important;
                            text-transform: uppercase !important;
                        }

                        
                        
                        .section-nagivation_new {
                            margin-bottom: 50px;
                        }
                        
                        .navigation-title_new {
                            background: #f5801d54;
                            padding: 8px 30px;
                            border-bottom: 3px solid #f5801d;
                        }
                        .navigation-form-wrapper_new td {
                            color: #555;
                            font-size: 12px;
                            text-align: center;
                            cursor: pointer;
                            width: 10%;
                        }
                        .main-navigation ul ul
                                {
                                    top:60px !important;
                                }
                                .main-navigation ul ul li 
                                {
                                    background: #131922 !important;
                                }
                        table {
                            margin-bottom: 10px;
                            overflow: hidden;
                            box-shadow: 0 0 20px rgb(0 0 0 / 10%);
                            border-spacing: 0;
                            border-width: 1px 0 0 1px;
                            margin: 0 0 1.5em;
                            width: 100%;
                            border: 1px solid #dddddd;
                        
                        }
                        
                        .active {
                            background: #F6D0B0 !important;
                        }
                        
                        th.table-head-data_new {
                            width: 10%;
                            text-align: right;
                            color: #333;
                            font-size: 14px;
                            padding: 15px;
                            background-color: rgba(255, 255, 255, 0.2);
                            border-width: 0 1px 1px 0;
                            font-weight: 700;
                            border: 1px solid #dddddd;
                            font-family: Cairo, sans-serif;
                            color:#333 !important;
                            line-height: 21px;
                        }
                        
                        th.table-head-data-sm {
                            width: 30%;
                            text-align: center;
                            color: #333;
                            font-size: 14px;
                            padding: 15px;
                            background-color: rgba(255, 255, 255, 0.2);
                            border-width: 0 1px 1px 0;
                            font-weight: 700;
                            border: 1px solid #dddddd;
                            font-family: Cairo, sans-serif;
                            color:#333 !important;
                            line-height: 21px;
                        }
                        
                        td {
                            text-align: center;
                            cursor: pointer;
                            width: 10%;
                            color: #444;
                            font-size: 13px;
                            position: relative;
                            padding: 15px;
                            background-color: rgba(255, 255, 255, 0.2);
                            border-width: 0 1px 1px 0;
                            border: 1px solid #dddddd;
                            line-height: 21px;
                        }
                        
                        .dater {
                            color: #000000 !important;
                            box-shadow: none;
                            text-decoration: none !important;
                            transition: all .2s linear;
                            transition-property: all;
                            transition-duration: 0.2s;
                            transition-timing-function: linear;
                            transition-delay: 0s;
                            background-color: transparent !important;
                            font-size: 13px;
                            border: none;
                        }
                        
                        .dater:hover, .dater:focus {
                        
                            color: #e54a42 !important;
                        }

                        .date-selector_new:hover, .date-selector_new:focus {
                        
                            background: #F6D0B0;
                        }
                        
                        .entry-content_new{
                            font-size: 18px;
                            font-size: 1.25rem;
                            font-family: "Rakkas",display;
                            margin-bottom: 0.5rem;
                            font-weight: 500 !important;
                            line-height: 1.2;
                        }
                        .away-team-new . desktop-new {
                            display: inline-flex;
                        }
                        
                        .tv-shows-table-team-sort-new td {
                            padding: 15px 8px;
                            color: #444;
                            font-size: 13px;
                            text-align: center;
                            cursor: pointer;
                            width: 19% !important;
                            position: relative;
                            border-width: 0 1px 1px 0;
                            background-color: rgba(255, 255, 255, 0.2);
                            border: 1px solid #dddddd;
                        }
                        
                        .tv-shows-table-team-sort-new select, .tv-shows-table-team-sort-new input[type=text] {
                            padding: 5px 10px;
                            width: 100%;
                            border-radius: 0;
                            border: none;
                            font-family: "Cairo",sans-serif;
                            font-weight: 400;
                            font-size: 1rem;
                            line-height: 1.5;
                        }
                        select {
                            color: #666;
                            height: auto;
                            background: #fafafa;
                            box-shadow: none;
                            transition: all .2s linear;
                            transition-property: all;
                            transition-duration: 0.2s;
                            transition-timing-function: linear;
                            transition-delay: 0s;
                            margin: 0;
                            vertical-align: baseline;
                            font: inherit;
                        }
                        
                        select:not(:-internal-list-box) {
                            overflow: visible !important;
                        }
                        
                        input[type=email], input[type=number], input[type=password], input[type=search], input[type=tel], input[type=text], input[type=url], select, textarea {
                            color: #666;
                            height: auto;
                            background: #fafafa;
                            box-shadow: none;
                            box-sizing: border-box;
                            transition: all .2s linear;
                            
                        }
                        
                        body, button, input, select, textarea, .ast-button, .ast-custom-button {
                            font-family: "Cairo",sans-serif;
                            font-weight: 400;
                            font-size: 15px;
                            font-size: 1rem;
                            line-height: 1.5;
                        }
                        
                        .reset-btn.button {
                            display: inline-block;
                            opacity: .7;
                            width: 100%;
                        }
                        
                        input[type="submit"], input[type="reset"]{
                            width: 100%;
                            border-style: solid;
                            border-top-width: 0;
                            border-right-width: 0;
                            border-left-width: 0;
                            border-bottom-width: 0;
                            color: #ffffff !important;
                            border-color: #e16a38;
                            background-color: #e16a38 !important;
                            border-radius: 0;
                            padding-top: 17px;
                            padding-right: 30px;
                            padding-bottom: 17px;
                            padding-left: 30px;
                            font-family: inherit;
                            font-weight: 700;
                            font-size: 11px;
                            font-size: 0.73333333333333rem;
                            line-height: 1;
                            text-transform: uppercase;
                            letter-spacing: 2px;
                        }
                        
                        input[type="submit"]:hover{
                            color: #ffffff !important;
                            background-color: #e54a42 !important;
                            border-color: #e54a42 !important;
                        }
                        
                        input[type="submit"]:focus{
                            background-color: #e54a42 !important;
                            border-color: #e54a42 !important;
                            color: #ffffff !important;
                        }
                        
                        
                        input[type="reset"]:focus{
                            background-color: #e54a42 !important;
                            border-color: #e54a42 !important;
                            color: #ffffff !important;
                        }
                        
                        
                        .button {
                            color: #ffffff !important;
                            border-style: solid;
                            border-top-width: 0;
                            border-right-width: 0;
                            border-left-width: 0;
                            border-bottom-width: 0;
                            border-color: #e16a38 !important;
                            background-color: #e16a38 !important;
                            border-radius: 0;
                            padding-top: 17px;
                            padding-right: 30px;
                            padding-bottom: 17px;
                            padding-left: 30px;
                            font-family: inherit;
                            font-weight: 700;
                            font-size: 11px;
                            font-size: 0.73333333333333rem;
                            line-height: 1;
                            text-transform: uppercase;
                            letter-spacing: 2px;
                        }
                        
                        
                        .match-info-table-new.same-table-inline-new table {
                            border: none;
                            box-shadow: none;
                        }
                        
                        .table-head-row-new, .table-head-row-new:hover {
                            background: #ddd;
                        }
                        
                        .table-head-row-new th:first-child, .table-data-infos-new td:first-child {
                            border-left: 1px solid #ddd;
                            font-family: "Cairo",sans-serif;
                        }
                        .match-info-table-new.same-table-inline-new th, .match-info-table-new.same-table-inline-new td {
                            text-align: left;
                        }
                        .match-prediction-page-wrapper-new th {
                            color: #333;
                            font-size: 14px;
                        }
                        .larg-width-the-new {
                            padding: 0;
                            padding-left: 10px;
                        }
                        
                        .small-width-th {
                            padding: 0;
                            padding-left: 10px;
                            font-size: 12px;
                            font-family: "Cairo",sans-serif !important;
                        }
                        
                        
                        .match-head-new {
                            position: relative;
                        }

                        .match-head-new img{
                            width: 40px;
                            height: 50px;
                            max-width: 100%;
                            border: none;
                            border-radius: 0;
                            -webkit-box-shadow: none;
                            box-shadow: none;
                            vertical-align: middle;
                            color: #333;
                            font-size: 14px;
                        }

                        .info-standings-new img{
                            width: 40px;
                            height: 40px;
                            max-width: 100%;
                            border: none;
                            border-radius: 0;
                            -webkit-box-shadow: none;
                            box-shadow: none;
                            vertical-align: middle;
                            color: #333;
                            font-size: 14px;
                        }
                        .tounament-popup-icon img{
                            width: 40px;
                            height: 40px;
                            max-width: 100%;
                            border: none;
                            border-radius: 0;
                            -webkit-box-shadow: none;
                            box-shadow: none;
                            vertical-align: middle;
                            color: #333;
                            font-size: 14px;
                        }
                        
                        .th{
                            background: #ddd;
                        }
                        .table-head-row-new th:first-child, .table-data-infos-new td:first-child {
                            border-left: 1px solid #ddd;
                            font-family: "Cairo",sans-serif;
                        }
                        
                        .match-info-table-new.same-table-inline-new th, .match-info-table-new.same-table-inline-new td {
                            text-align: left;
                        }
                        
                         #site-navigation ul li a {
                            width: 100% !important;
                        }
                        span.lg-name-country-new {
                            padding-left: 10px;
                        }
                        
                        span.sm-name-country {
                            display: flex;
                            justify-content: center;
                            color: white;
                            background-color: black;
                            
                        }
                        
                        .match-info-table-new.same-table-inline-new th, .match-info-table-new.same-table-inline-new td {
                            text-align: left;
                        }
                        
                        
                        .table-head-row-new th:first-child, .table-data-infos-new td:first-child {
                            border-left: 1px solid #ddd;
                            font-family: "Cairo",sans-serif;
                        }
                        
                        
                        .single-pred-match .same-table-inline-new td {
                            padding: 0;
                            line-height: unset;
                        }
                        
                        .match-info-table-new.same-table-inline-new th, .match-info-table-new.same-table-inline-new td {
                            text-align: left;
                        }
                        .same-table-inline-new td {
                            text-align: center;
                        }
                        .match-prediction-page-wrapper-new td {
                            color: #444;
                            font-size: 13px;
                        }
                        .small-width-th {
                            width: 5%;
                        }
                        .match-info-inner-new {
                            padding: 5px 15px;
                        }
                        
                        .match-time-new {
                            margin-right: 10px;
                            width: 10%;
                            display: inline-block;
                        }
                        
                        .match-time-sm {
                            padding-left: 12px;
                            display: inline-block;
                            padding-top: 10px;
                            padding-bottom: 10px;
                        }
                        
                        span.home-team-new {
                            width: 30%;
                            display: inline-block;
                            text-align: right;
                        }
                        span.wordbreak-css-new.tv-wordbreak-new {
                            display: inline-grid;
                            justify-content: start;
                        }
                        
                        span.wordbreak-css-sm.tv-wordbreak-sm {
                            display: inline-grid;
                            padding-left: 12px;
                        }
                        span.wordbreak-css-new {
                            width: 140px;
                            display: inline-grid;
                            line-height: 12px;
                            align-items: center;
                            justify-content: center;
                            font-size: 15px;
                        }
                        
                        span.wordbreak-css-sm {
                            display: inline-grid;
                            line-height: 12px;
                            padding-left: 12px;
                            width: 60%;
                            padding-top: 10px;
                            padding-bottom: 10px;
                        }
                        .home-t-point-new {
                            background: #999;
                            width: 25px;
                            display: inline-block;
                            height: 30px;
                            text-align: center;
                            color: #fff;
                            line-height: 30px;
                            text-shadow: 0.5px 0.5px 1px;
                        }
                        .away-team-new.desktop-new {
                            display: inline-flex;
                            width: 30%;
                        }
                        .away-t-point-new {
                            background: #999;
                            width: 25px;
                            display: inline-block;
                            height: 30px;
                            text-align: center;
                            color: #fff;
                            line-height: 30px;
                            text-shadow: 0.5px 0.5px 1px;
                        }
                        
                        .away-t-point-sm {
                            background: #999;
                            width: 25px;
                            display: inline-block;
                            height: 30px;
                            text-align: center;
                            color: #fff;
                            line-height: 30px;
                            text-shadow: 0.5px 0.5px 1px;
                            margin-left: 10%;
                        }
                       
                        td.hide-on-mobile-new.tv-small-data-new {
                            position: relative;
                            background: #333;
                        }
                        span.td-inner-new.single-tv-new {
                            background: #333;
                            padding: 10px;
                            font-size: 17px;
                            width: 100%;
                        }
                        
                        
                        
                        .td-inner-new {
                            padding: 10px;
                            display: inline-block;
                            width: 10%;
                            text-align: center;
                            text-shadow: 0.5px 0.5px 1px;
                            color: #fff;
                        }
                        span.td-inner-new.single-tv-new img {
                            width: 60px !important;
                            height: 40px;
                        
                        }
                        
                        .extra-tv-logos-new {
                            
							position: fixed;
                        top: 6%;
                        height: 90%;
                        width: 83%;
                        display: none;
                        background: #333;
                        padding: 30px 15px;
                        right: 43%;
                        text-align: center;
                        margin-right: -33%;
                        z-index: 99999;
                        }
                        
                        .extra-tv-logos-sm {
                                position: fixed;
                                top: 10%;
                                width: 80%;
								height: 90%;
                                display: none;
                                background: #333;
                                padding: 15px 7.5px;
                                right: 10%;
                                text-align: center;
                                z-index: 99999;
                        }
                        
                        span.tv-logo-closer-new {
                            background: #F58221;
                            color: #fff;
                            width: 30px;
                            height: 30px;
                            display: inline-block;
                            position: absolute;
                            top: -15px;
                            right: -15px;
                            line-height: 30px;
                            border-radius: 25px;
                            z-index: 100005;
                        }
                        
                        .extra-tv-logos-inner-new {
                            height: 90%;
                            overflow-y: auto;
                        }
                        
                        
                        .extra-tv-logos-inner-sm {
                            height: 90%;
                            overflow-y: auto;
                        }
                        
                        .extra-tv-logos-new img {
                            width: 140px;
                            padding: 10px;
                            margin-bottom: 5px;
                        }

                        .extra-tv-logos-sm img {
                            width: 80px;
                            padding: 10px;
                            border: 1px solid;
                            margin-bottom: 5px;
                        }
                        .reload-img{
                        
                        width : 1200px !important;
                        height: 400px !important;
                        }
                        
                        @media screen and (max-width: 425px) {
                            .hideer {
                                display: block !important;
                            }
                        
                            .shower {
                                display: none !important;
                            }
                        
                            .cont {
                                max-width: 360px !important;
                                font-family: "Big Shoulders Display", display !important;
                            }
							.main-navigation ul ul
                                {
                                    top:0px !important;
                                }

                            .reload-img{
                        
                                width : 330px !important;
                                height: 150px !important;
                                }
                        }
                    </style>
                    <div class="container-fluid cont" style="width: 1230px;">
                        <div class="text-center">
                            <h2 class="headings">' . $live_tv . ' <span id="date_live">' . $date_66 . '</span></h2>
                        </div>
                        <div class="section-nagivation_new">
                            <h5 class="navigation-title_new entry-content_new">' . $navigation . '</h5>
                            <div class="navigation-form-wrapper_new">
                                    <table class="table-sort-date shower">
                                        <tbody>
                                            <tr>
                                                <td class="date-selector_new active" id="td_4" onclick="seturl1(this)"><button   id="btn_1" class="dater" name="TODAY" style="font-weight: 800;">' . $TODAY . '</button></td>
                                                <td class="date-selector_new " id="td_4" onclick="seturl2(this)"><button   id="btn_2" class="dater" name="TOMORROW" style="font-weight: 800;">' . $TOMORROW . '</button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="table-sort-by tv-shows-table-team-sort-new shower" style="    overflow: auto;">
                                        <tbody>
                                            <tr>
                                               
                                                <td class="sort-selector team-sorting-selct">
                                                    <div class="fl-dropdown-country" id="teamcountry-desk" onclick="show_country()" >' . $all_countries . '</div>
                                                    <div class="fl-dropdown-menu-country" id="child-div-country" style="background: #bccfe0;" >';
            $v = 1;
            if ($countryArray != NULL) {

                for ($p = 0; $p < count($countryArray); $p++) {
                    $c = 'id_c_' . $v;
                    $v++;
                    $y = $y . '<label class="btn btn-light fl-label-country" id= "' . $c . '" name= "' . $countryArray[$p][0] . '" onclick="setcountry(this)"><img src="' . $countryArray[$p][1] . '" width="20px" height="20px" alt="" style="border-radius: 50%;"> ' . $countryArray[$p][0] . '</label>';
                }
            }

            $y = $y . '
                                                    </select>
                                                </td>
                                                <td class="sort-selector team-sorting-selct">
                                                <div class="fl-dropdown" onclick="show()" >' . $all_leagues . '</div>
                                                <div class="fl-dropdown-menu" id="child-div" style="background: #bccfe0;" >
                                                ';
            $j = 1;

            if ($leagueArray != NULL) {
                for ($d = 0; $d < count($leagueArray); $d++) {
                    $k = 'id_' . $j;
                    $j++;
                    $namer = $leaguecountry[$d] . ' _ ' . $leagueArray[$d];
                    $y = $y . '<label class="btn btn-light fl-label" id= "' . $k . '" name= "' . $namer . '" onclick="setleague1(this)"><img src="' . $leagueflag[$d] . '" width="40px" height="40px" alt="league"> ' . $leaguecountry[$d] . '-' . $leagueArray[$d] . '</label>';
                }
            }
            $y = $y . '</div>';

            $y = $y . ' </td>
                                                <th class="table-head-data_new">' . $search_team . '</th>
                                                <td class="sort-selector team-sorting-selct">
                                                    <input type="text" placeholder="' . $search_team_name . '" name="teamname" id="teamname" value="">
                                                </td>
                                                <td class="sort-selector team-sorting-selct">
                                                    <input type="submit" value="' . $filter . '" onclick="ajaxCall(12,0)">
                                                </td>
                                                <td class="sort-selector team-sorting-selct">
                                                    <button class="reset-btn button" style="color: white;" onclick="ajaxCall(2,0)">' . $reset . '</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="table-sort-date table-sort-by tv-shows-table-team-sort-new hideer" style="display: none;">
                                        <tbody>
                                            <tr>
                                            <td class="date-selector_new active" id="td_4" style="font-family: "Cairo",sans-serif !important;" onclick="seturl3(this)"><button id="btn_3" class="dater" name="TODAY" style="font-weight: 800;">' . $TODAY . '</button></td>
                                            <td class="date-selector_new" id="td_4" style="font-family: "Cairo",sans-serif !important;" onclick="seturl4(this)"><button id="btn_4" class="dater" name="TOMORROW" style="font-weight: 800;">' . $TOMORROW . '</button></td>
                                            </tr>
                                            <tr>
                                                <td class="sort-selector team-sorting-selct">
                                                    <select name="teamcountry" id="teamcountry" onchange="setcountry1()">
                                                        <option value=""> ' . $all_countries . ' </option>
                                                        ';
            if ($countryArray != NULL) {
                for ($p = 0; $p <= count($countryArray); $p++) {
                    $y = $y . '<option value="' . $countryArray[$p][0] . '" style="background-image:url(' . $countryArray[$p][1] . ');"><img src="" width="20px" height="20px" alt="" style="border-radius: 50%;">' . $countryArray[$p][0] . '</option>';
                }
            }

            $y = $y . '
                                                    </select>
                                                </td>
                                                <td class="sort-selector team-sorting-selct">
                                                <select name="teamleague" id="teamleague" onchange="setleague(3)">
                                                <option value="none">' . $all_leagues . '</option>
                                                ';
            if ($leagueArray != NULL) {
                for ($d = 0; $d <= count($leagueArray); $d++) {
                    $y = $y . '<option value="' . $leagueArray[$d] . '">' . $leaguecountry[$d] . '-' . $leagueArray[$d] . '</option>';
                }
            }

            $y = $y . '
                                            </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="table-head-data-sm">' . $search_team . '</th>
                                                <td class="sort-selector team-sorting-selct">
                                                    <input type="text" placeholder="' . $search_team_name . '" name="teamname" id="teamname" value="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="sort-selector team-sorting-selct" colspan="2">
                                                    <input type="submit" value="' . $filter . '"  onclick="ajaxCall(12,0)">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="sort-selector team-sorting-selct" colspan="2" onclick="ajaxCall(2,0)">
                                                    <button class="reset-btn button" style="color: white;" >' . $reset . '</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                            </div>
                            ';
            if ($country != "" && $country != "none") {

                $y = $y . '<script> document.getElementById("teamcountry-desk").innerHTML = "' . $country . '"; </script> ';
            }
            $y = $y . '
                            <div class="section-predicted-matches-wrapper">
                                <h5 class="navigation-title_new entry-content_new">' . $headline . '</h5>
                                <div class="single-pred-match-wrap">
                                    <div class="single-pred-match">
                                    <img src="https://scorebet24.com/wp-content/uploads/2022/09/b8717641f46cdfdced2c86e984f07c11.gif" class="reload-img" id="loader" >

                                        <div class="match-info-table-new same-table-inline-new" id="3row">
                                        
                                                
                                        </div>    
                                        <div class="match-info-table-new same-table-inline-new" id="33row">
                                        
                                        </div> 
                                        ' . $this->my_action_javascript($language, $country, $image) . ' 
                                                <script>
                                                    ajaxCall(0,0); // To output when the page loads
                                                    setInterval(ajaxCall, (600000)); // x * 1000 to get it in seconds
                                                </script>   
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script type="text/javascript" src="blob:https://scorebet24.com/5299bfb3-2f65-471e-b331-c2557f442658"></script>
                    <script>
                        function myFunction(id) {
                            var x = document.getElementById(id);
                            x.style.display = "block";
                        }
                    </script>
                    <script>
                        function myFunction2(id) {
                            var x = document.getElementById(id);
                            x.style.display = "none";
                        }
                    </script>
                    <script>
                        function myFunction_sm(id) {
                            var x = document.getElementById(id);
                            x.style.display = "block";
                        }
                    </script>
                    <script>
                        function myFunction2_sm(id) {
                            var x = document.getElementById(id);
                            x.style.display = "none";
                        }
                    </script>';

            return $y;
        } else {
            return "DB Error";
        }
    }
}
$FLDview = new FootballLeagueDataview;
