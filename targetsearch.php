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
	$alliance = "showall";
	}
	
if(isset($_GET['colonies']) && is_numeric($_GET['colonies'])){
	$colonies = $_GET['colonies'];
} else {
	$colonies = 3;
	}
	
if(isset($_GET['toprank']) && is_numeric($_GET['toprank'])){
	$toprank = $_GET['toprank'];
} else {
	$toprank = 1;
	}
	
if(isset($_GET['bottomrank']) && is_numeric($_GET['bottomrank'])){
	$bottomrank = $_GET['bottomrank'];
} else {
	$bottomrank = 50000;
	}
	
$alliancelist = mysql_query("SELECT DISTINCT alliance FROM planets WHERE slot NOT LIKE '%m' AND slot NOT LIKE '%e' ORDER BY alliance ASC") or die(mysql_error());

if(($galaxy !== "") && ($alliance === "showall")){
$results = mysql_query("SELECT *, COUNT(*) as count FROM planets WHERE galaxy = '$galaxy' AND rank >= '$toprank' AND rank <= '$bottomrank' AND slot NOT LIKE '%m' AND slot NOT LIKE '%e' GROUP BY player, galaxy, system HAVING count >= '$colonies' ORDER BY galaxy ASC, system ASC ") or die(mysql_error());
} elseif(($galaxy === "") && ($alliance !== "showall")){
if($alliance === "noalliancetag"){$alliance = "";}
$results = mysql_query("SELECT *, COUNT(*) as count FROM planets WHERE rank >= '$toprank' AND rank <= '$bottomrank' AND slot NOT LIKE '%m' AND slot NOT LIKE '%e' AND alliance = '$alliance' GROUP BY player, galaxy, system HAVING count >= '$colonies' ORDER BY galaxy ASC, system ASC") or die(mysql_error());
if($alliance === ""){$alliance = "noalliancetag";}
} elseif(($galaxy !== "") && ($alliance !== "showall")){
if($alliance === "noalliancetag"){$alliance = "";}
$results = mysql_query("SELECT *, COUNT(*) as count FROM planets WHERE galaxy = '$galaxy' AND rank >= '$toprank' AND rank <= '$bottomrank' AND slot NOT LIKE '%m' AND slot NOT LIKE '%e' AND alliance = '$alliance' GROUP BY player, galaxy, system HAVING count >= '$colonies' ORDER BY galaxy ASC, system ASC") or die(mysql_error());
if($alliance === ""){$alliance = "noalliancetag";}
} 
//BUILD THE PAGE
include('headinclude.php'); 
include('navigation.php'); ?>

		<div class="well">
			Target Search
			<span style="float:right;"><a href="search.php">New search</a></span>
				<div class="explain" style="align:center; font-size:100%">
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" style="margin:8px 0 0 0;"> 
					Galaxy: <select name="galaxy" onChange="this.form.submit()" style="width:60px;">
					<option value="" <?php if($galaxy===""){echo 'selected="selected"';}?>>-----</option>
					<?php 
					for($i=1; $i <= $galaxy_count; $i++) {
						echo '<option value="'.$i.'" '; if($galaxy==="$i"){echo 'selected="selected"';} echo '>'.$i.'</option>';
					} 
					echo '</select>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Alliance: <select name="alliance" onChange="this.form.submit()" style="width:150px;">
					<option value="showall"'; if($alliance === "showall"){echo 'selected="selected"';}echo'>-----</option>'; 
					while($list = mysql_fetch_assoc($alliancelist)){
					echo '<option value="'; if($list['alliance'] === ""){echo 'noalliancetag'; } else { echo $list['alliance'];} echo'"'; if(($alliance === "noalliancetag") && ($list['alliance'] === "")){echo 'selected="selected"';} elseif($alliance === $list['alliance']){echo 'selected="selected"';} echo '>'.htmlspecialchars(stripslashes($list['alliance'])).'</option>';
					}
					echo'</select>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Colonies in system: <select name="colonies" onChange="this.form.submit()" style="width:60px;">';
					echo '<option value="1"'; if($colonies === "1"){echo 'selected="selected"';} echo '>1</option>';
					echo '<option value="2"'; if($colonies === "2"){echo 'selected="selected"';} echo '>2</option>';
					echo '<option value="3"'; if($colonies === "3"){echo 'selected="selected"';} echo '>3</option>';
					echo '<option value="4"'; if($colonies === "4"){echo 'selected="selected"';} echo '>4</option>';
					echo '<option value="5"'; if($colonies === "5"){echo 'selected="selected"';} echo '>5</option>';
					echo '<option value="6"'; if($colonies === "6"){echo 'selected="selected"';} echo '>6</option>';
					echo '<option value="7"'; if($colonies === "7"){echo 'selected="selected"';} echo '>7</option>';
					echo '<option value="8"'; if($colonies === "8"){echo 'selected="selected"';} echo '>8</option>';
					echo '<option value="9"'; if($colonies === "9"){echo 'selected="selected"';} echo '>9</option>';
					echo'</select>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ranks: <input type="text" class="input-mini" placeholder="1" name="toprank" value="'; if(isset($_GET['toprank'])){echo $toprank;} echo'"> to <input type="text" class="input-mini" placeholder="50000" name="bottomrank" value="'; if(isset($_GET['bottomrank'])){echo $bottomrank;} echo'"><input type="submit" value="GO" class="inputTextBtn" />';?>
				</div>
				<table width="100%" class="table-striped" id="tablelist">
					<thead><tr>
						<th align="left">Player</th>
						<th align="left">Rank</th>
						<th align="left">Alliance</th>
						<th align="left">Colonies</th>
						<th align="right">Coordinates</td>
					</tr></thead><tbody>
						<?php 
						if(isset($results)){
						while($planets = mysql_fetch_assoc($results)){ 
							echo "
							<tr>
								<td><a href=\"search.php?cp=".$currentplanet."&search=p&exact=true&query=".$planets['player']."\">".stripslashes($planets['player'])."</a>";
								if($planets['status'] !== ""){echo "<span style=\"font-size:80% !important;\"'>&nbsp;(".$planets['status'].")&nbsp;</span>";}
							echo "</td>";
							echo "<td>".number_format($planets['rank'])."</td>";
							echo "<td><a href=\"search.php?cp=".$currentplanet."&search=a&exact=true&query=".$planets['alliance']."\">".htmlspecialchars(stripslashes($planets['alliance']))."</a></td>";
							echo "<td>".$planets['count']."</td>";
							echo "<td align=\"right\"><a href=".$game_url."/galaxy/show?current_planet=".$currentplanet."&galaxy=".$planets['galaxy']."&solar_system=".$planets['system'].">[".$planets['galaxy'].":".$planets['system']."]</a></span></td>
							</tr>"; }}	?>			
						</tbody></table>
	</div>
	<script type="text/javascript">
		$(document).ready(function() 
			{ 
				$("#tablelist").tablesorter(); 
			} 
		); 
	</script>	
	<?php include('footinclude.php');