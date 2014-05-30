<?php 
//INCLUDE THE CONFIGURATION / CONNECT TO DATABASE
include('config.php');

//GET URL VARIABLES FROM URL AND SET OTHER VARIABLES
if(isset($_GET['galaxy']) && is_numeric($_GET['galaxy'])){
	$galaxy = $_GET['galaxy'];
} else {
	$galaxy = "";
}

if(isset($_GET['race'])){
	$race = mysql_real_escape_string($_GET['race']);
} else {
	$race = "";
	}
	
if(isset($_GET['type'])){
	$type = mysql_real_escape_string($_GET['type']);
} else {
	$type = "";
	}
	
$results = 0;

//NOTHING SELECTED
if(($galaxy === "") && ($race === "") && ($type ==="")){
$results = mysql_query("SELECT * FROM planets WHERE slot LIKE '%t' ORDER BY galaxy ASC, system ASC, slot ASC") or die(mysql_error());
} 

//JUST GALAXY SELECTED
elseif(($galaxy !== "") && ($race === "") && ($type ==="")){
$results = mysql_query("SELECT * FROM planets WHERE galaxy = '$galaxy' AND slot LIKE '%t' ORDER BY galaxy ASC, system ASC, slot ASC") or die(mysql_error());
} 

//JUST TYPE SELECTED
elseif (($galaxy === "") && ($race === "") && ($type !=="")){
$results = mysql_query("SELECT * FROM planets WHERE planet = '$type' AND slot LIKE '%t' ORDER BY galaxy ASC, system ASC, slot ASC") or die(mysql_error());
}

//JUST RACE SELECTED
elseif (($galaxy === "") && ($race === "Player") && ($type ==="")){
$results = mysql_query("SELECT * FROM planets WHERE slot LIKE '%t' ORDER BY galaxy ASC, system ASC, slot ASC") or die(mysql_error());
} elseif (($galaxy === "") && ($race === "Unowned") && ($type ==="")){
$results = mysql_query("SELECT * FROM planets WHERE slot LIKE '%t' AND player = 'Hostile Force' ORDER BY galaxy ASC, system ASC, slot ASC") or die(mysql_error());
}

//JUST GALAXY AND A RACE
elseif (($galaxy !== "") && ($race === "Player") && ($type ==="")){
$results = mysql_query("SELECT * FROM planets WHERE galaxy = '$galaxy' AND slot LIKE '%t' AND player NOT LIKE 'Hostile Force' ORDER BY galaxy ASC, system ASC, slot ASC") or die(mysql_error());
} elseif (($galaxy !== "") && ($race === "Unowned") && ($type ==="")){
$results = mysql_query("SELECT * FROM planets WHERE galaxy = '$galaxy' AND slot LIKE '%t' AND player = 'Hostile Force' ORDER BY galaxy ASC, system ASC, slot ASC") or die(mysql_error());
} 

//JUST GALAXY AND A TYPE
elseif(($galaxy !== "") && ($race === "") && ($type !=="")){
$results = mysql_query("SELECT * FROM planets WHERE galaxy = '$galaxy' AND planet = '$type' AND slot LIKE '%t' ORDER BY galaxy ASC, system ASC, slot ASC") or die(mysql_error());
} 

//JUST A RACE AND TYPE
 elseif (($galaxy === "") && ($race === "Player") && ($type !=="")){
$results = mysql_query("SELECT * FROM planets WHERE planet = '$type' AND slot LIKE '%t' AND player NOT LIKE 'Hostile Force' ORDER BY galaxy ASC, system ASC, slot ASC") or die(mysql_error());
} elseif (($galaxy === "") && ($race === "Unowned") && ($type !=="")){
$results = mysql_query("SELECT * FROM planets WHERE planet = '$type' AND slot LIKE '%t' AND player = 'Hostile Force' ORDER BY galaxy ASC, system ASC, slot ASC") or die(mysql_error());
}

//GALAXY, RACE, and TYPE
elseif (($galaxy !== "") && ($race === "Player") && ($type !=="")){
$results = mysql_query("SELECT * FROM planets WHERE galaxy = '$galaxy' AND planet = '$type' AND slot LIKE '%t' AND player NOT LIKE 'Hostile Force' ORDER BY galaxy ASC, system ASC, slot ASC") or die(mysql_error());
} elseif (($galaxy !== "") && ($race === "Unowned") && ($type !=="")){
$results = mysql_query("SELECT * FROM planets WHERE galaxy = '$galaxy' AND planet = '$type' AND slot LIKE '%t' AND player = 'Hostile Force' ORDER BY galaxy ASC, system ASC, slot ASC") or die(mysql_error());
}  


//BUILD THE PAGE
include('headinclude.php'); 
include('navigation.php'); ?>

		<div class="well">
			Encounter Search
			<span style="float:right;"><a href="search.php">New search</a></span>
				<div class="explain" style="align:center; font-size:100%">
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" style="margin:8px 0 0 0;"> 
					Galaxy: <select name="galaxy" onChange="this.form.submit()" style="width:100px;">
					<option value="" <?php if($galaxy===""){echo 'selected="selected"';}?>>-----</option>
					<?php 
					for($i=1; $i <= $galaxy_count; $i++) {
						echo '<option value="'.$i.'" '; if($galaxy==="$i"){echo 'selected="selected"';} echo '>'.$i.'</option>';
					} 
					echo '</select>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Owner: <select name="race" onChange="this.form.submit()">
					<option value=""'; if($race === ""){echo 'selected="selected"';}echo'>All Territories</option>'; 
					echo '<option value="Player" '; if($race==="Player"){echo 'selected="selected"';} echo '>Player Occupied</option>';
					echo '<option value="Unowned" '; if($race==="Unowned"){echo 'selected="selected"';} echo '>Unoccupied Territories</option>';
					echo'</select>
					
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Territory Type: <select name="type" onChange="this.form.submit()">';
					echo '<option value=""'; if($type === ""){echo 'selected="selected"';}echo'>All Types</option>'; 					
					echo '<option value="Advanced Factory" '; if($type==="Advanced Factory"){echo 'selected="selected"';} echo '>Advanced Factory</option>';
					echo '<option value="Alien Experiment" '; if($type==="Alien Experiment"){echo 'selected="selected"';} echo '>Alien Experiment</option>';
					echo '<option value="Alien Space Dock" '; if($type==="Alien Space Dock"){echo 'selected="selected"';} echo '>Alien Space Dock</option>';
					echo '<option value="Labor" '; if($type==="Labor"){echo 'selected="selected"';} echo '>Labor</option>';
					echo '<option value="Missile Silo" '; if($type==="Missile Silo"){echo 'selected="selected"';} echo '>Missile Silo</option>';
					echo '<option value="Resource Vault" '; if($type==="Resource Vault"){echo 'selected="selected"';} echo '>Resource Vault</option>';
					echo'</select>
					</form> 
				</div>';
				
				echo '<table width="100%" class="table-striped" id="tablelist">
							<thead><tr>
									<th align="left">Owner</th>
									<th align="left">Territory Type</th>
									<th align="left">Coordinates</td>
									<th align="right">Time Added</th>
								</tr></thead><tbody>';
					if($results !== 0){
							while($planets = mysql_fetch_assoc($results)){ 
							if ($planets['player'] === 'Hostile force') {echo "<tr><td>".stripslashes($planets['player'])."</td>"; } else{
							echo "<tr><td><a href=\"search.php?cp=".$currentplanet."&search=p&exact=true&query=".htmlspecialchars(stripslashes($planets['player']))."\">".htmlspecialchars(stripslashes($planets['player']))."</a></td>";}
							echo "<td>".stripslashes($planets['planet']);
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
			}; 
			echo "</td>";
							echo "<td><a href=".$game_url."/galaxy/show?current_planet=".$currentplanet."&galaxy=".$planets['galaxy']."&solar_system=".$planets['system'].">[".$planets['galaxy'].":".$planets['system'].":".$planets['slot']."]</a></span></td>";
							echo "<td align=\"right\">".date("m-d-Y H:i:s",$planets['timeupdated'])."</td>";
							echo"</tr>"; }}	?>			
						</tbody></table>
	</div>
	
	<?php include('footinclude.php');
