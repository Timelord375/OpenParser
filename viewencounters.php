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

if(($galaxy !== "") && ($race === "") && ($type ==="")){
$results = mysql_query("SELECT * FROM planets WHERE galaxy = '$galaxy' AND slot LIKE '%e' AND player NOT LIKE 'territory' ORDER BY galaxy ASC, system ASC, slot ASC") or die(mysql_error());
} elseif (($galaxy !== "") && ($race !== "") && ($type ==="")){
$results = mysql_query("SELECT * FROM planets WHERE galaxy = '$galaxy' AND slot LIKE '%e' AND player = '$race' ORDER BY galaxy ASC, system ASC, slot ASC") or die(mysql_error());
} elseif(($galaxy !== "") && ($race !== "") && ($type !=="")){
$results = mysql_query("SELECT * FROM planets WHERE galaxy = '$galaxy' AND planet = '$type' AND slot LIKE '%e' AND player = '$race' ORDER BY galaxy ASC, system ASC, slot ASC") or die(mysql_error());
} elseif(($galaxy === "") && ($race !== "") && ($type !=="")){
$results = mysql_query("SELECT * FROM planets WHERE planet = '$type' AND slot LIKE '%e' AND player = '$race' ORDER BY galaxy ASC, system ASC, slot ASC") or die(mysql_error());
} elseif(($galaxy === "") && ($race !== "") && ($type ==="")){
$results = mysql_query("SELECT * FROM planets WHERE slot LIKE '%e' AND player = '$race' ORDER BY galaxy ASC, system ASC, slot ASC") or die(mysql_error());
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
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NPC Race: <select name="race" onChange="this.form.submit()">
					<option value=""'; if($race === ""){echo 'selected="selected"';}echo'>-----</option>'; 
					echo '<option value="Krug" '; if($race==="Krug"){echo 'selected="selected"';} echo '>Krug</option>';
					echo '<option value="Urcath" '; if($race==="Urcath"){echo 'selected="selected"';} echo '>Urcath</option>';
					echo '<option value="Seekers" '; if($race==="Seekers"){echo 'selected="selected"';} echo '>Seekers</option>';
					echo'</select>
					
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Encounter Type: <select name="type" onChange="this.form.submit()">';
					echo '<option value=""'; if($type === ""){echo 'selected="selected"';}echo'>-----</option>'; 
					if($race === "Krug" || $race === "Urcath"){
					echo '<option value="Abandoned Cruiser" '; if($type==="Abandoned Cruiser"){echo 'selected="selected"';} echo '>Abandoned Cruiser</option>';
					echo '<option value="Abandoned Warship" '; if($type==="Abandoned Warship"){echo 'selected="selected"';} echo '>Abandoned Warship</option>';
					echo '<option value="Small Enemy Fleet" '; if($type==="Small Enemy Fleet"){echo 'selected="selected"';} echo '>Small Enemy Fleet</option>';
					echo '<option value="Enemy Fleet" '; if($type==="Enemy Fleet"){echo 'selected="selected"';} echo '>Enemy Fleet</option>';
					echo '<option value="Large Enemy Fleet" '; if($type==="Large Enemy Fleet"){echo 'selected="selected"';} echo '>Large Enemy Fleet</option>';
					echo '<option value="Floating Colony" '; if($type==="Floating Colony"){echo 'selected="selected"';} echo '>Floating Colony</option>';
					echo '<option value="Large Floating Colony" '; if($type==="Large Floating+Colony"){echo 'selected="selected"';} echo '>Large Floating Colony</option>';
					} elseif ($race === "Seekers") {
					echo '<option value="Abanndoned Cruiser" '; if($type==="Abandoned Cruiser"){echo 'selected="selected"';} echo '>Abandoned Cruiser</option>';
					echo '<option value="Abandoned Warship" '; if($type==="Abandoned Warship"){echo 'selected="selected"';} echo '>Abandoned Warship</option>';
					echo '<option value="Large Abandoned Warship" '; if($type==="Large Abandoned Warship"){echo 'selected="selected"';} echo '>Large Abandoned Warship</option>';
					echo '<option value="Abandoned Leviathan" '; if($type==="Abandoned Leviathan"){echo 'selected="selected"';} echo '>Abandoned Leviathan</option>';
					echo '<option value="Large Abandoned Leviathan" '; if($type==="Large Abandoned Leviathan"){echo 'selected="selected"';} echo '>Large Abandoned Leviathan</option>';
					echo '<option value="Abandoned Colossus Platform" '; if($type==="Abandoned Colossus Platform"){echo 'selected="selected"';} echo '>Abandoned Colossus Platform</option>';
					}
					echo'</select>
					</form> 
				</div>';
				
				echo '<table width="100%" class="table-striped" id="tablelist">
							<thead><tr>
									<th align="left">NPC Race</th>
									<th align="left">Encounter</th>
									<th align="left">Coordinates</td>
									<th align="right">Time Added</th>
								</tr></thead><tbody>';
					if($results !== 0){
							while($planets = mysql_fetch_assoc($results)){ 
							echo "<tr><td>".stripslashes($planets['player'])."</td>";
							echo "<td>".stripslashes($planets['planet'])."</td>";
							echo "<td><a href=".$game_url."/galaxy/show?current_planet=".$currentplanet."&galaxy=".$planets['galaxy']."&solar_system=".$planets['system'].">[".$planets['galaxy'].":".$planets['system'].":".$planets['slot']."]</a></span></td>";
							echo "<td align=\"right\">".date("m-d-Y H:i:s",$planets['timeupdated'])."</td>";
							echo"</tr>"; }}	?>			
						</tbody></table>
	</div>
	
	<?php include('footinclude.php');
