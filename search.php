<?php 
//INCLUDE THE CONFIGURATION / CONNECT TO DATABASE
include('config.php'); 
		
//GET URL VARIABLES FROM URL AND SET OTHER VARIABLES
$searchtype = mysql_real_escape_string($_GET['search']);
$searchquery = mysql_real_escape_string(trim($_GET['query']));
$exactsearch = mysql_real_escape_string($_GET['exact']);
$currentplanet = mysql_real_escape_string($_GET['cp']);
$hour = date("H"); //SO WE KNOW WHICH BOX TO HIGHLIGHT

//REDIRECT TERRITORY SEARCHES

if(($is_uni === 'guns') && ($searchtype === 'p') && (strcasecmp($searchquery, 'hostile force') == 0)) {
	header("Location: http://guns.siteurl.com/viewterritories.php");
}

//WHAT KIND OF SEARCH IS THIS? GET DATA!
switch($searchtype) {
	case "a":
		if ($exactsearch === "true") {
			$explain = 1;
			$results = mysql_query("SELECT * FROM planets WHERE alliance='".$searchquery."' AND slot NOT LIKE '' AND alliance NOT LIKE '' ORDER BY player ASC, galaxy ASC, system ASC, slot ASC");
			if($results){$resultcount = mysql_num_rows($results);}
		} else { 
			$explain = 1;
			$limitsearch=1;
			$results = mysql_query("SELECT * FROM planets WHERE alliance LIKE '".$searchquery."%' AND slot NOT LIKE '' AND alliance NOT LIKE '' ORDER BY alliance ASC, player ASC, galaxy ASC, system ASC, slot ASC");
			if($results){$resultcount = mysql_num_rows($results);}
		}
		break;
	case "p":
		if ($exactsearch === "true"){
			$explain = 0;
			$results = mysql_query("SELECT * FROM planets WHERE player='".$searchquery."' AND slot NOT LIKE '' AND slot NOT LIKE '%e' ORDER BY galaxy ASC, system ASC, slot ASC");
			if($results){$resultcount = mysql_num_rows($results);}
			$hephdata = mysql_query("SELECT * FROM heph_tracker WHERE player='".$searchquery."' ORDER BY timeupdated DESC");
			if($hephdata){$ishephdata = mysql_num_rows($hephdata);}
		} else {
			$explain = 1;
			$limitsearch=1;
			$results = mysql_query("SELECT * FROM planets WHERE player LIKE '".$searchquery."%' AND slot NOT LIKE '' ORDER BY player ASC, galaxy ASC, system ASC, slot ASC");
			if($results){$resultcount = mysql_num_rows($results);}
		}
		break;
	case "h":
		$hephsearch = 1;
		if ($exactsearch === "true") {
			$results = mysql_query("SELECT * FROM heph_tracker WHERE player='".$searchquery."' ORDER BY timeupdated DESC");
			if($results){$resultcount = mysql_num_rows($results);}
		} else { 
			$explain = 1;
			$results = mysql_query("SELECT * FROM planets WHERE slot LIKE '%h' ORDER BY timeupdated DESC");
			if($results){$resultcount = mysql_num_rows($results);}
		}
		break;
	default:
		$plainsearch = 1;
}

//BUILD THE PAGE
include('headinclude.php'); 
include('navigation.php'); ?>

		<div class="well">
			<?php
			//DO WE NEED TO BUILD A SEARCH BOX? IF YES, DECIDE IF A SEARCH HAD NO RESULT OR IF THIS IS A NEW SEARCH.			
			if($resultcount === 0 || $plainsearch === 1){
				echo '<div class="form-search" style="text-align:center;">
					<h1>What should we search for?</h1>';
					if($resultcount === 0) {
						echo'<div class="alert alert-error" style="width:600px; margin: 0px auto;"><h4 class="alert-heading"><strong>No results found!</strong></h4>
						<p>Unfortunately, no results were found matching your search criteria. Try again?</p></div><br />'; }
							echo'<form action="search.php" method="get">
							<input type="text" class="input-xxlarge" title="Search Box" name="query" id="query"><input type="submit" value="Search" class="inputTextBtn" onclick="check(this.form); return false;" ><br />
							<p><input type="radio" name="search" value="p" style="vertical-align:top" checked>&nbsp;Player Name&nbsp;&nbsp;&nbsp;or&nbsp;&nbsp;&nbsp;<input type="radio" name="search" value="a" style="vertical-align:top">&nbsp;Alliance Tag&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="exact" value="true" style="vertical-align:top" checked>&nbsp;Exact Search&nbsp;&nbsp;&nbsp;or&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="exact" value="false" style="vertical-align:top">&nbsp;Begins With</p>
							</form>
					</div>'; 
			} elseif(($resultcount > 1000) && ($limitsearch===1)) {
							echo '<div class="form-search" style="text-align:center;">
					<h1>What should we search for?</h1>';
					if($resultcount > 1000) {
						echo'<div class="alert alert-error" style="width:600px; margin: 0px auto;"><h4 class="alert-heading"><strong>More than 1000 results found!</strong></h4>
						<p>Unfortunately, we found too many results. Please refine your search and try again.</p></div><br />'; }
							echo'<form action="search.php" method="get">
							<input type="text" class="input-xxlarge" title="Search Box" name="query" id="query"><input type="submit" value="Search" class="inputTextBtn" onclick="check(this.form); return false;" ><br />
							<p><input type="radio" name="search" value="p" style="vertical-align:top" checked>&nbsp;Player Name&nbsp;&nbsp;&nbsp;or&nbsp;&nbsp;&nbsp;<input type="radio" name="search" value="a" style="vertical-align:top">&nbsp;Alliance Tag&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="exact" value="true" style="vertical-align:top" checked>&nbsp;Exact Search&nbsp;&nbsp;&nbsp;or&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="exact" value="false" style="vertical-align:top">&nbsp;Begins With</p>
							</form>
					</div>'; 
			} else {
			//NO SEARCH BOX WAS NEEDED BECAUSE WE FOUND RESULTS, LET'S DISPLAY THEM!
			if(($hephsearch === 1) && ($searchquery === "")){
				echo'Showing '; if($is_uni === 'sde' || $is_uni === 'sden'){echo "Titan";} else {echo "Heph";} echo' Locations';
			}elseif($searchquery !== ""){echo 'Search results for <strong>'.htmlspecialchars(stripslashes(stripslashes($searchquery))).'</strong>';} ?>
		<span style="float:right;"><a href="search.php">New search</a></span>
		
					<?php if($explain === 0){ ?>
						<!--IF AN EXACT SEARCH, SHOW BUTTONS TO EXPAND TRACKING -->
						<div class="explain" style="align:center;">
						<i class="icon-user"></i>&nbsp;<a data-toggle="collapse" data-target=".tracker" href="#">
						Show / Hide Tracking Info</a>
							<?php 
							//HIDE THE HEPH LINKS IF WE DON'T HAVE ANY HEPH DATA
							if($ishephdata > 0){echo'&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
							<a data-toggle="collapse" data-target="#hephTracker" href="#"><i class="icon-search"></i>&nbsp;Show / Hide '; if($is_uni === 'sde' || $is_uni === 'sden'){echo "Titan";} else {echo "Heph";} echo' Tracker </a>'; } 
						echo'</div>';
						 } elseif($explain === 1){ ?>
							<!--IF NOT AN EXACT SEARCH, SHOW THE GENERAL INFO BAR -->
							<div class="explain" style="align:center;">
								Click on player name to gain additional options and information!
							</div><?php }
						if($ishephdata > 0){echo'
							<div id="hephTracker" class="collapse" style="text-align:center;">
										<h1>'; if($is_uni === 'sde' || $is_uni === 'sden'){echo "Titan ";} else {echo "Heph ";} echo 'Tracking</h1>';
											$i = 0;							
											while(($heph = mysql_fetch_assoc($hephdata)) && ($i < 5)){					
													echo "<span>".date("m-d-Y H:i:s",$heph['timeupdated'])."</span> - <span><a href=".$game_url."/galaxy/show?current_planet=".$currentplanet."&galaxy=".$heph['galaxy']."&solar_system=".$heph['system'].">[".$heph['galaxy'].":".$heph['system'].":".$heph['slot']."]</a></span><br />";	
													$i++;
												}											
											if($ishephdata > 5){
												echo "<br /><span>Only the latest five results shown. <a href=\"search.php?cp=".$currentplanet."&search=h&exact=true&query=".$heph['player']."\">Click here to see more</a>.</span>";}
							echo'<br /></div>	'; } 							
							//IS THIS A HEPH SEARCH, FORMAT ACCORDINGLY	
							if(($hephsearch === 1) && ($exactsearch === "true")) {
								echo '<div style="text-align:center;"><h1>'; if($is_uni === 'sde' || $is_uni === 'sden'){echo "Titan ";} else {echo "Heph ";} echo "Tracking data for <a href=\"search.php?cp=".$currentplanet."&search=p&exact=true&query=".$searchquery."\">".$searchquery."</a></h1>";
									while($heph = mysql_fetch_assoc($results)){					
											echo "<span>".date("m-d-Y H:i:s",$heph['timeupdated'])."</span> - <span><a href=".$game_url."/galaxy/show?current_planet=".$currentplanet."&galaxy=".$heph['galaxy']."&solar_system=".$heph['system'].">[".$heph['galaxy'].":".$heph['system'].":".$heph['slot']."]</a></span><br />";	
									} echo' </div>';
							} elseif(($hephsearch === 1) && ($exactsearch !== "true")) {
							//LIST ALL THE HEPH RESULTS
							echo '<table width="100%" class="table-striped" id="tablelist">
								<thead><tr>
									<th align="left">Player</th>
									<th align="left">Rank</th>
									<th align="left">Alliance</th>
									<th align="left">Colony</th>
									<th align="left">Coordinates</th>
									<th align="right">Time Added</th>
								</tr></thead><tbody>';
							while($planets = mysql_fetch_assoc($results)){ 
							echo "
							<tr>
								<td><a href=\"search.php?cp=".$currentplanet."&search=p&exact=true&query=".$planets['player']."\">".stripslashes($planets['player'])."</a>";
								if(preg_match('[h]', $planets['slot'])) { 
									 echo '<img src="/assets/img/';if($is_uni ==='sde'){echo'sde';} else{echo'sfc';}echo'_roaming_planet.png" border="0" style="padding-left:15px;height:16px;width:16px">';}
								if($planets['status'] !== ""){echo "<span style=\"font-size:80% !important;\"'>&nbsp;(".$planets['status'].")&nbsp;</span>";}
							echo "</td>";
							echo "<td>".number_format($planets['rank'])."</td>";
							echo "<td><a href=\"search.php?cp=".$currentplanet."&search=a&exact=true&query=".$planets['alliance']."\">".stripslashes($planets['alliance'])."</a></td>";
							echo "<td>".htmlspecialchars(stripslashes($planets['planet']))."</td>";
							echo "<td><a href=".$game_url."/galaxy/show?current_planet=".$currentplanet."&galaxy=".$planets['galaxy']."&solar_system=".$planets['system'].">[".$planets['galaxy'].":".$planets['system'].":".$planets['slot']."]</a></span></td>";
							echo "<td align=\"right\">".date("m-d-Y H:i:s",$planets['timeupdated'])."</td>";
							}
							echo "</tr></tbody></table>";	
							}  else {				
							//NOT A HEPH SEARCH? OKAY, LIST ALL THE PLANET RESULTS
							echo '<table width="100%" class="table-striped" id="tablelist">
							<thead><tr>
									<th align="left">Player</th>
									<th align="left">Rank</th>
									<th align="left">Alliance</th>
									<th align="left">Colony</th>
									<th align="right">Coordinates</td>
								</tr></thead><tbody>';

							if($results){while($planets = mysql_fetch_assoc($results)){ 
							echo "
							<tr>
								<td><a href=\"search.php?cp=".$currentplanet."&search=p&exact=true&query=".htmlspecialchars(stripslashes($planets['player']))."\">".htmlspecialchars(stripslashes($planets['player']))."</a>";
								if(preg_match('[m]', $planets['slot'])) { 
									echo '<img src="/assets/img/moon.png" border="0" style="padding-left:15px;">'; 
								} elseif(preg_match('[h]', $planets['slot'])) { 
									 echo '<img src="/assets/img/';if($is_uni ==='sde'){echo'sde';} else{echo'sfc';}echo'_roaming_planet.png" border="0" style="padding-left:15px;height:16px;width:16px">';
								} elseif(($is_uni === 'guns') && (preg_match('[t]', $planets['slot']))) {
			if ($planets['planet'] === 'Advanced Factory') { 
				echo '&nbsp;<img src="http://'.$_SERVER['SERVER_NAME'].'/assets/img/advanced_factory.png" border="0" style="height:16px;width:16px">'; 
			} elseif ($planets['planet'] === 'Alien Experiment') { 
				echo '&nbsp;<img src="http://'.$_SERVER['SERVER_NAME'].'/assets/img/alien_experiment.png" border="0" style="height:16px;width:16px">'; 
			} elseif ($planets['planet'] === 'Alien Space Dock') { 
				echo '&nbsp;<img src="http://'.$_SERVER['SERVER_NAME'].'/assets/img/alien_space_dock.png" border="0" style="height:16px;width:16px">'; 
			} elseif ($planets['planet'] === 'Labor') { 
				echo '&nbsp;<img src="http://'.$_SERVER['SERVER_NAME'].'/assets/img/labor.png" border="0" style="height:16px;width:16px">'; 
			} elseif ($planets['planet'] === 'Missile Silo') { 
				echo '&nbsp;<img src="http://'.$_SERVER['SERVER_NAME'].'/assets/img/missile_silo.png" border="0" style="height:16px;width:16px">'; 
			} elseif ($planets['planet'] === 'Resource Vault') { 
				echo '&nbsp;<img src="http://'.$_SERVER['SERVER_NAME'].'/assets/img/resource_vault.png" border="0" style="height:16px;width:16px">'; 
			} 
		}
									 
								if($planets['status'] !== ""){echo "<span style=\"font-size:80% !important;\"'>&nbsp;(".$planets['status'].")&nbsp;</span>";}
							echo "</td>";
							echo "<td>".number_format($planets['rank'])."</td>";
							echo "<td><a href=\"search.php?cp=".$currentplanet."&search=a&exact=true&query=".$planets['alliance']."\">".htmlspecialchars(stripslashes($planets['alliance']))."</a></td>";
							echo "<td>".htmlspecialchars(stripslashes($planets['planet']))."</td>";
							echo "<td align=\"right\"><a href=".$game_url."/galaxy/show?current_planet=".$currentplanet."&galaxy=".$planets['galaxy']."&solar_system=".$planets['system'].">[".$planets['galaxy'].":".$planets['system'].":".$planets['slot']."]</a></span></td>
							</tr>";
							
							//IF WE'VE SEARCHED FOR JUST ONE PLAYER, LET'S SHOW SOME TRACKER DATA!
							if ($exactsearch === "true" && $searchtype ==="p") {
							echo '			
							<tr>
								<td colspan="5">
								<div class="collapse tracker">
								<div style="padding:10px;">
								<table width="100%">';
								//IF IT'S A HEPH, WE DON'T KEEP HOUR BY HOUR TRACKER DATA. SORRY. =(
								if(preg_match('[h]', $planets['slot'])) { 
										if($ishephdata > 0) {
												echo '<thead><tr><th class="TrackerHours">Please use the ';
												if($is_uni === 'sde' || $is_uni === 'sden'){echo "Titan";} else {echo "Heph";}
												echo ' Tracker link to see recent locations!</th></tr></thead>';
											} 
								} else {
								
								//IF IT'S A PLANET, WE CAN LOOK IT UP IN THE TRACKER!
								$trackerdata = mysql_query("SELECT * FROM planets_activity WHERE galaxy='".$planets['galaxy']."' AND system='".$planets['system']."' AND slot='".$planets['slot']."' AND player='".$searchquery."'");										
								while($tracker = mysql_fetch_assoc($trackerdata)){
											
								//LIST ALL THE HOURS IN THE DAY (UTC STYLE!!)
								for ($i = 0; $i <24; $i++) {
									$j = sprintf("%02s",$i);
									$td1 = "";
										if ($i === 0) { $td1 .= '<thead><tr>';}				
										if ($hour === $j){
											$td1 .= '<th class="TrackerHours" style="border:2px solid black;">'.$j.'</td>';		
										} else {
											$td1 .= '<th class="TrackerHours">'.$j.'</td>';
										}
										if ($i === 23) { $td1 .= '</tr></thead>'; } 
								echo $td1;
								}
								//HOW OFTEN HAVE WE SEEN ACTIVITY AND COLOR CODE THE RESULTS!
								for ($i = 0; $i <24; $i++) {
									$j = sprintf("%02s",$i);
									$td2 = "";
									$ts = $j."_ts";
										if ($tracker[''.$ts.''] === "0") {
											$trackervalue = number_format(1, 2, '.', '');
											$red = 200;
											$green = 200;
											$blue = 200;
										} else {
											$trackervalue = $tracker[''.$j.''] / $tracker[''.$ts.''];
												if($trackervalue >= 5) {
													$red = 255;
												} else {
													$red = round((255 * $trackervalue) / 10);
												}
												if ($trackervalue <= 5) {
													$green = 255;
												} else {
													$green = round((255*(10 - $trackervalue)) / 10);
												}
											$blue = 0;
										 	$trackervalue = number_format($trackervalue, 2, '.', '');
										}	
									if ($i === 0) { $td2 .= '<tbody><tr>';}				
									if ($hour === $j){
										$td2 .= '<td class="TrackerValues" style="border:2px solid black; background-color:rgb('.$red.','.$green.','.$blue.');">'.$trackervalue.'</td>';		
									} else {
										$td2 .= '<td class="TrackerValues" style="background-color:rgb('.$red.','.$green.','.$blue.');">'.$trackervalue.'</td>';
										}
										if ($i === 23) { $td2 .= '</tr></tbody>'; } 
								echo $td2;
								} 
								
							}
							}
							echo' </table></div></div></td></tr>';
							}
							}}
							}}?>
						 </table>
							
															
		</td>
	</tr>
	</table>
	</div>

	<script type="text/javascript">
		function check(what){	
			var length=what.query.value.length;	
			if (length > 1)
			what.submit();
		else
			alert("Your search must be at least two characters long.");
		}
	</script>

<?php include('footinclude.php');