<?php
date_default_timezone_set('UTC');
$host = "localhost"; //database location
$user = "db_user"; //database username
$pass = "db_password"; //database password


if(isset($_SERVER['SERVER_NAME'])){
	switch($_SERVER['SERVER_NAME']){
		case 'openparser.com':
			$site_title = 'Open Parser for Starfleet Commander and Stardrift Empires';
			$is_uni = 'null';
			$bootstrap = 'blue_bootstrap';
		break;
		case 'www.openparser.com':
			$site_title = 'Open Parser for Starfleet Commander and Stardrift Empires';
			$is_uni = 'null';
			$bootstrap = 'blue_bootstrap';
		break;
		case 'sfo.openparser.com':
			$database = 'db_name_sfo'; //SFO Parser Database
			$site_title = 'Open Parser for Starfleet Commander Original Universe';
			$game_url = 'http://playstarfleet.com';
			$galaxy_count = 35;
			$is_uni = 'sfo';
			$bootstrap = 'blue_bootstrap';
		break;		
		case 'uni2.openparser.com':
			$database = 'db_name_uni2'; //Uni2 Parser Database
			$site_title = 'Open Parser for Starfleet Commander Universe 2';
			$game_url = 'http://uni2.playstarfleet.com';
			$galaxy_count = 10;
			$is_uni = 'uni2';
			$bootstrap = 'blue_bootstrap';
		break;					
		case 'x1.openparser.com':
			$database = 'db_name_x1'; //X1 Parser Database
			$site_title = 'Open Parser for Starfleet Commander Extreme 1';
			$game_url = 'http://playstarfleetextreme.com';
			$galaxy_count = 9;
			$is_uni = 'x1';
			$bootstrap = 'red_bootstrap';
		break;
		case 'x2.openparser.com':
			$database = 'db_name_x2'; //X2 Parser Database
			$site_title = 'Open Parser for Starfleet Commander Extreme 2';
			$game_url = 'http://uni2.playstarfleetextreme.com';
			$galaxy_count = 9;
			$is_uni = 'x2';
			$bootstrap = 'red_bootstrap';
		break;
		case 'nova.openparser.com':
			$database = 'db_name_nova'; //Nova Parser Database
			$site_title = 'Open Parser for Starfleet Commander Nova';
			$game_url = 'http://nova.playstarfleet.com';
			$galaxy_count = 10;
			$is_uni = 'nova';
			$bootstrap = 'orange_bootstrap';
		break;
		case 'sde.openparser.com':
			$database = 'db_name_sde'; //SDE Parser Database
			$site_title = 'Open Parser for Stardrift Empires';
			$game_url = 'http://stardriftempires.com';
			$galaxy_count = 25;
			$is_uni = 'sde';
			$bootstrap = 'yellow_bootstrap';
		break;
		case 'sdenova.openparser.com':
			$database = 'db_name_sde_nova'; //SDE Nova Parser Database
			$site_title = 'Open Parser for Stardrift Empires Nova';
			$game_url = 'http://nova.stardriftempires.com';
			$galaxy_count = 10;
			$is_uni = 'sden';
			$bootstrap = 'yellow_bootstrap';
		break;
		case 'conquest.openparser.com':
			$database = 'db_name_conquest'; //SFC Conquest Parser Database
			$site_title = 'Open Parser for Starfleet Commander Conquest';
			$game_url = 'http://conquest.playstarfleet.com';
			$galaxy_count = 5;
			$is_uni = 'conq';
			$bootstrap = 'blue_bootstrap';
		break;
		case 'guns.openparser.com':
			$database = 'db_name_guns'; //SFC Hired Guns Parser Database
			$site_title = 'Open Parser for Starfleet Commander Hired Guns';
			$game_url = 'http://guns.playstarfleet.com';
			$galaxy_count = 5;
			$is_uni = 'guns';
			$bootstrap = 'red_bootstrap';
		break;
		case 'uni3.openparser.com':
			$database = 'db_name_uni3'; //SFC Uni 3 Parser Database
			$site_title = 'Open Parser for Starfleet Commander Universe 3';
			$game_url = 'http://uni3.playstarfleet.com';
			$galaxy_count = 5;
			$is_uni = 'uni3';
			$bootstrap = 'blue_bootstrap';
		break;
			}
		}

$con = mysql_connect($host,$user,$pass);
mysql_select_db($database, $con);
?>