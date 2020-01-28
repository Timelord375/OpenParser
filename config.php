<?php
error_reporting( error_reporting() & ~E_NOTICE );
date_default_timezone_set('UTC');
$host = "localhost"; //database location
$user = "db_user"; //database username
$pass = "db_password"; //database password

if(isset($_SERVER['SERVER_NAME'])){
	switch($_SERVER['SERVER_NAME']){
		case 'siteurl.com':
			$site_title = 'Open Parser for Starfleet Commander and Stardrift Empires';
			$is_uni = 'null';
			$bootstrap = 'blue_bootstrap';
		break;
		case 'www.siteurl.com':
			$site_title = 'Open Parser for Starfleet Commander and Stardrift Empires';
			$is_uni = 'null';
			$bootstrap = 'blue_bootstrap';
		break;
		case 'sfo.siteurl.com':
			$database = 'db_name_sfo_parser'; //SFO Parser Database
			$site_title = 'Open Parser for Starfleet Commander Original Universe';
			$game_url = 'http://playstarfleet.com';
			$galaxy_count = 35;
			$is_uni = 'sfo';
			$bootstrap = 'blue_bootstrap';
		break;		
		case 'uni2.siteurl.com':
			$database = 'db_name_uni2_parser'; //Uni2 Parser Database
			$site_title = 'Open Parser for Starfleet Commander Universe 2';
			$game_url = 'http://uni2.playstarfleet.com';
			$galaxy_count = 10;
			$is_uni = 'uni2';
			$bootstrap = 'blue_bootstrap';
		break;					
		case 'x1.siteurl.com':
			$database = 'db_name_x1_parser'; //X1 Parser Database
			$site_title = 'Open Parser for Starfleet Commander Extreme 1';
			$game_url = 'http://playstarfleetextreme.com';
			$galaxy_count = 9;
			$is_uni = 'x1';
			$bootstrap = 'red_bootstrap';
		break;
		case 'x2.siteurl.com':
			$database = 'db_name_x2_parser'; //X2 Parser Database
			$site_title = 'Open Parser for Starfleet Commander Extreme 2';
			$game_url = 'http://uni2.playstarfleetextreme.com';
			$galaxy_count = 9;
			$is_uni = 'x2';
			$bootstrap = 'red_bootstrap';
		break;
			case 'x6.siteurl.com':
			$database = 'db_name_x6_parser'; //X6 Parser Database
			$site_title = 'Open Parser for Starfleet Commander Extreme 6';
			$game_url = 'https://x6.playstarfleet.com';
			$galaxy_count = 9;
			$is_uni = 'x6';
			$bootstrap = 'red_bootstrap';
		break;
		case 'nova.siteurl.com':
			$database = 'db_name_nova_parser'; //Nova Parser Database
			$site_title = 'Open Parser for Starfleet Commander Nova';
			$game_url = 'http://nova.playstarfleet.com';
			$galaxy_count = 10;
			$is_uni = 'nova';
			$bootstrap = 'orange_bootstrap';
		break;
		case 'tournament.siteurl.com':
			$database = 'db_name_tourny_parser'; //Tournament Parser Database
			$site_title = 'Open Parser for Starfleet Commander Tournamnet';
			$game_url = 'http://tournament.playstarfleet.com';
			$galaxy_count = 4;
			$is_uni = 'tourny';
			$bootstrap = 'blue_bootstrap';
		break;
		case 'sde.siteurl.com':
			$database = 'db_name_sde_parser'; //SDE Parser Database
			$site_title = 'Open Parser for Stardrift Empires';
			$game_url = 'http://stardriftempires.com';
			$galaxy_count = 25;
			$is_uni = 'sde';
			$bootstrap = 'yellow_bootstrap';
		break;
		case 'sdenova.siteurl.com':
			$database = 'db_name_sden_parser'; //SDE Nova Parser Database
			$site_title = 'Open Parser for Stardrift Empires Nova';
			$game_url = 'http://nova.stardriftempires.com';
			$galaxy_count = 10;
			$is_uni = 'sden';
			$bootstrap = 'yellow_bootstrap';
		break;
		case 'conquest.siteurl.com':
			$database = 'db_name_conq_parser'; //SFC Conquest Parser Database
			$site_title = 'Open Parser for Starfleet Commander Conquest';
			$game_url = 'http://conquest.playstarfleet.com';
			$galaxy_count = 5;
			$is_uni = 'conq';
			$bootstrap = 'blue_bootstrap';
		break;
		case 'guns.siteurl.com':
			$database = 'db_name_guns_parser'; //SFC Hired Guns Parser Database
			$site_title = 'Open Parser for Starfleet Commander Hired Guns';
			$game_url = 'http://guns.playstarfleet.com';
			$galaxy_count = 5;
			$is_uni = 'guns';
			$bootstrap = 'red_bootstrap';
		break;
		case 'uni3.siteurl.com':
			$database = 'db_name_uni3_parser'; //SFC Uni 3 Parser Database
			$site_title = 'Open Parser for Starfleet Commander Universe 3';
			$game_url = 'http://uni3.playstarfleet.com';
			$galaxy_count = 5;
			$is_uni = 'uni3';
			$bootstrap = 'blue_bootstrap';
		break;
		case 'eradeon.siteurl.com':
			$database = 'db_name_erad_parser'; //SFC Erad Parser Database
			$site_title = 'Open Parser for Starfleet Commander Eradeon';
			$game_url = 'http://eradeon.playstarfleet.com';
			$galaxy_count = 5;
			$is_uni = 'erad';
			$bootstrap = 'blue_bootstrap';
		break;
		case 'eradeon2.siteurl.com':
			$database = 'db_name_erad2_parser'; //SFC Erad Extreme Parser Database
			$site_title = 'Open Parser for Starfleet Commander Eradeon Extreme';
			$game_url = 'http://eradeon2.playstarfleet.com';
			$galaxy_count = 5;
			$is_uni = 'erad2';
			$bootstrap = 'blue_bootstrap';
		break;
		case 'eradeon3.siteurl.com':
			$database = 'db_name_erad3_parser'; //SFC Erad 3 Parser Database
			$site_title = 'Open Parser for Starfleet Commander Eradeon Universe 3';
			$game_url = 'http://eradeon3.playstarfleet.com';
			$galaxy_count = 5;
			$is_uni = 'erad3';
			$bootstrap = 'blue_bootstrap';
		break;
		case 'conquest2.siteurl.com':
			$database = 'db_name_conq2_parser'; //SFC Conquest 2 Parser Database
			$site_title = 'Open Parser for Starfleet Commander Conquest Universe 2';
			$game_url = 'http://conquest2.playstarfleet.com';
			$galaxy_count = 5;
			$is_uni = 'conq2';
			$bootstrap = 'blue_bootstrap';
		break;
			}
		}

$con = mysql_connect($host,$user,$pass);
mysql_select_db($database, $con);
?>
