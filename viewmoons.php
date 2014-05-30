<?php 
//INCLUDE THE CONFIGURATION / CONNECT TO DATABASE
include('config.php');

//GET URL VARIABLES FROM URL AND SET OTHER VARIABLES
if(isset($_GET['galaxy']) && is_numeric($_GET['galaxy'])){
	$galaxy = $_GET['galaxy'];
} else {
	$galaxy = "";
}

if(isset($_GET['alliance'])){
	$alliance = mysql_real_escape_string($_GET['alliance']);
} else {
	$alliance = "0";
	}
	
$alliancelist = mysql_query("SELECT DISTINCT alliance FROM planets WHERE slot LIKE '%m' ORDER BY alliance ASC") or die(mysql_error());

if(($galaxy !== "") && ($alliance === "")){
$results = mysql_query("SELECT * FROM planets WHERE galaxy = '$galaxy' AND slot LIKE '%m' ORDER BY galaxy ASC, system ASC, slot ASC") or die(mysql_error());
} elseif(($galaxy === "") && ($alliance !== "")){
$results = mysql_query("SELECT * FROM planets WHERE slot LIKE '%m' AND alliance = '$alliance' ORDER BY galaxy ASC, system ASC, slot ASC") or die(mysql_error());
} elseif(($galaxy !== "") && ($alliance !== "")){
$results = mysql_query("SELECT * FROM planets WHERE galaxy = '$galaxy' AND slot LIKE '%m' AND alliance = '$alliance' ORDER BY galaxy ASC, system ASC, slot ASC") or die(mysql_error());
}

//BUILD THE PAGE
include('headinclude.php'); 
include('navigation.php'); ?>
		<div class="well">
			Moon Overview
			<span style="float:right;"><a href="search.php">New search</a></span>
				<div class="explain" style="align:center; font-size:100%">
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" style="margin:8px 0 0 0;"> 
					Galaxy: <select name="galaxy" onChange="this.form.submit()">
					<option value="" <?php if($galaxy===""){echo 'selected="selected"';}?>>-----</option>
					<?php 
					for($i=1; $i <= $galaxy_count; $i++) {
						echo '<option value="'.$i.'" '; if($galaxy==="$i"){echo 'selected="selected"';} echo '>'.$i.'</option>';
					} 
					echo '</select>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Alliance: <select name="alliance" onChange="this.form.submit()">
					<option value=""'; if($alliance === "0"){echo 'selected="selected"';}echo'>-----</option>'; 
					while($list = mysql_fetch_assoc($alliancelist)){
					echo '<option value="'.$list['alliance'].'" '; if($alliance===$list['alliance']){echo 'selected="selected"';} echo '>'.$list['alliance'].'</option>';
					} 
										
					echo'</select>
					</form> 
				</div>';
				
				echo '<table width="100%" class="table-striped" id="tablelist">
							<thead><tr>
									<th align="left">Player</th>
									<th align="left">Rank</th>
									<th align="left">Alliance</th>
									<th align="left">Colony</th>
									<th align="right">Coordinates</td>
								</tr></thead><tbody>';
							if(isset($results)){
							while($planets = mysql_fetch_assoc($results)){ 
							echo "
							<tr>
								<td><a href=\"search.php?cp=".$currentplanet."&search=p&exact=true&query=".$planets['player']."\">".stripslashes($planets['player'])."</a>";
								if(preg_match('[m]', $planets['slot'])) { 
									echo '<img src="/assets/img/moon.png" border="0" style="padding-left:15px;">'; 
								} elseif(preg_match('[h]', $planets['slot'])) { 
									 echo '<img src="/assets/img/';if($isuni ===1){echo'sde';} else{echo'sfc';}echo'_roaming_planet.png" border="0" style="padding-left:15px;height:16px;width:16px">';}
								if($planets['status'] !== ""){echo "<span style=\"font-size:80% !important;\"'>&nbsp;(".$planets['status'].")&nbsp;</span>";}
							echo "</td>";
							echo "<td>".number_format($planets['rank'])."</td>";
							echo "<td><a href=\"search.php?cp=".$currentplanet."&search=a&exact=true&query=".$planets['alliance']."\">".stripslashes($planets['alliance'])."</a></td>";
							echo "<td>".stripslashes($planets['planet'])."</td>";
							echo "<td align=\"right\"><a href=".$game_url."/galaxy/show?current_planet=".$currentplanet."&galaxy=".$planets['galaxy']."&solar_system=".$planets['system'].">[".$planets['galaxy'].":".$planets['system'].":".$planets['slot']."]</a></span></td>
							</tr>"; }}	?>			
						</tbody></table>
	</div>

<?php include('footinclude.php');
