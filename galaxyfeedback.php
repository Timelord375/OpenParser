<?php
header("Access-Control-Allow-Origin: *");

//INCLUDE THE CONFIGURATION / CONNECT TO DATABASE
include('config.php'); 
		
//GET URL VARIABLES FROM URL AND SET OTHER VARIABLES
$player = mysql_real_escape_string($_GET['player']);
$currentplanet = mysql_real_escape_string($_GET['cp']);
$req = mysql_real_escape_string($_GET['req']);
$galaxy = mysql_real_escape_string($_GET['g']);
$system = mysql_real_escape_string($_GET['s']);
$slot = mysql_real_escape_string($_GET['slot']);
$slot .= "h";

if($req === 'hephsearch') {
$hephsearch = mysql_query("SELECT player FROM heph_tracker WHERE galaxy='".$galaxy."' AND system='".$system."' AND slot='".$slot."' ORDER BY timeupdated DESC LIMIT 1");
$hephresultcount = mysql_num_rows($hephsearch);
if($hephresultcount === 0) {
		$noresults = 1;
	} else {
		$player = mysql_result($hephsearch, 0);
	}
}

$results = mysql_query("SELECT * FROM planets WHERE player='".$player."' AND slot NOT LIKE '%e' AND slot NOT LIKE '' ORDER BY galaxy ASC, system ASC, slot ASC");
$resultscount = mysql_num_rows($results);
if($resultscount === 0) {
		$noresults = 1;
}
$hephresults = mysql_query("SELECT * FROM heph_tracker WHERE player='".$player."' ORDER BY timeupdated DESC LIMIT 10");
$hephresultcount = mysql_num_rows($hephresults);

if($is_uni !== 'sde'){
echo'
<head>
<style type="text/css">

#intelpop a {
  color: #00D5FF;
  outline: 0;
  text-decoration: none;
}
#intelpop a:hover {
    color: #00D5FF;
    text-decoration: underline;
  }
 </style>
 </head>'; }

if ($noresults === 1) { echo 'No data available!';
} else {
echo '<strong><a class="content" href="http://'.$_SERVER['SERVER_NAME'].'/search.php?cp='.$currentplanet.'&search=p&exact=true&query='.htmlspecialchars(stripslashes(stripslashes($player))).'" target="_blank">'.htmlspecialchars(stripslashes(stripslashes($player))).'</a></strong>';
echo '
<table cellspacing="20px" width="100%">
<tr><td valign="top">
<table width="100%">
		<thead><tr>
			<th align="left">Colony</th>
			<th>&nbsp;</th>
			<th align="right">Coords</td>
			</tr></thead><tbody>';
while($planets = mysql_fetch_assoc($results)){ 
		echo "<td>".htmlspecialchars(stripslashes($planets['planet']));
		if(preg_match('[m]', $planets['slot'])) { 
			echo '&nbsp;<img src="http://'.$_SERVER['SERVER_NAME'].'/assets/img/moon.png" border="0" style="height:10px;width:10px">'; 
		} elseif(preg_match('[h]', $planets['slot'])) { 
			echo '&nbsp;<img src="http://'.$_SERVER['SERVER_NAME'].'/assets/img/';if($is_uni === 'sde' || $is_uni === 'sden'){echo'sde';} else{echo'sfc';}echo'_roaming_planet.png" border="0" style="height:10px;width:10px">';
		} elseif(($is_uni === 'guns') && (preg_match('[t]', $planets['slot']))) {
			if ($planets['planet'] === 'Advanced Factory') { 
				echo '&nbsp;<img src="http://'.$_SERVER['SERVER_NAME'].'/assets/img/advanced_factory.png" border="0" style="height:10px;width:10px">'; 
			} elseif ($planets['planet'] === 'Alien Experiment') { 
				echo '&nbsp;<img src="http://'.$_SERVER['SERVER_NAME'].'/assets/img/alien_experiment.png" border="0" style="height:10px;width:10px">'; 
			} elseif ($planets['planet'] === 'Alien Space Dock') { 
				echo '&nbsp;<img src="http://'.$_SERVER['SERVER_NAME'].'/assets/img/alien_space_dock.png" border="0" style="height:10px;width:10px">'; 
			} elseif ($planets['planet'] === 'Labor') { 
				echo '&nbsp;<img src="http://'.$_SERVER['SERVER_NAME'].'/assets/img/labor.png" border="0" style="height:10px;width:10px">'; 
			} elseif ($planets['planet'] === 'Missile Silo') { 
				echo '&nbsp;<img src="http://'.$_SERVER['SERVER_NAME'].'/assets/img/missile_silo.png" border="0" style="height:10px;width:10px">'; 
			} elseif ($planets['planet'] === 'Resource Vault') { 
				echo '&nbsp;<img src="http://'.$_SERVER['SERVER_NAME'].'/assets/img/resource_vault.png" border="0" style="height:10px;width:10px">'; 
			} 
		}
		echo "</td><td>&nbsp;</td>";
		echo "<td align=\"right\"><a href=".$game_url."/galaxy/show?current_planet=".$currentplanet."&galaxy=".$planets['galaxy']."&solar_system=".$planets['system'].">[".$planets['galaxy'].":".$planets['system'].":".$planets['slot']."]</a></span></td>
	</tr>";}
echo '<tr><td colspan="3"><center><a href="http://'.$_SERVER['SERVER_NAME'].'/search.php?cp='.$currentplanet.'&search=p&exact=true&query='.$player.'" target="_blank">View tracking data</a>.</strong></center></td></tr>';
echo"</tbody></table>
</td>";
	
	
if($hephresultcount > 0){
	echo'<td>&nbsp;&nbsp;&nbsp;</td><td valign="top"><table width="100%">
			<thead><tr>
			<th align="left">'; if($is_uni === 'sde' || $is_uni === 'sden'){echo "Titan ";} else {echo "Heph ";} echo 'Location</th>
			<th>&nbsp;</th>
			<th align="right">Time Seen</th></tr></thead><tbody>';
	while($hephs = mysql_fetch_assoc($hephresults)){ 
		echo "<tr><td><a href=".$game_url."/galaxy/show?current_planet=".$currentplanet."&galaxy=".$hephs['galaxy']."&solar_system=".$hephs['system'].">[".$hephs['galaxy'].":".$hephs['system'].":".$hephs['slot']."]</a></td><td>&nbsp;</td>";	
		echo "<td>".date("m-d-Y H:i:s",$hephs['timeupdated'])."</td></tr>";
		}											
		if($hephresultcount === 10){
			echo '<tr><td colspan="3"><center><a href="http://'.$_SERVER['SERVER_NAME'].'/search.php?cp='.$currentplanet.'&search=h&exact=true&query='.$player.'" target="_blank">View more locations</a>.</center></td></tr>';}
	echo '</tbody></table>';
	}
echo'</td></tr></table>';}
include('foot2include.php');
?>