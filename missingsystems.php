<?php 
//INCLUDE THE CONFIGURATION / CONNECT TO DATABASE
include('config.php');

//GET URL VARIABLES FROM URL AND SET OTHER VARIABLES
if(isset($_GET['galaxy'])){
	$galaxy = mysql_real_escape_string($_GET['galaxy']);
} else {
	$galaxy = "";
}
if(isset($_GET['timeframe'])){
	$timeframe = mysql_real_escape_string($_GET['timeframe']);
} else {
	$timeframe = "604800";
}

//BUILD THE PAGE
include('headinclude.php'); 
include('navigation.php'); ?>
		<div class="well">
			Galaxy indexing overview: (<span style="color:Red;">Systems needing rescan</span>)
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
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Older than: <select name="timeframe" onChange="this.form.submit()"> 
					<option value="86400"'; if($timeframe==="86400"){echo 'selected="selected"';}echo'>1 days</option>
					<option value="172800"'; if($timeframe==="172800"){echo 'selected="selected"';}echo'>2 days</option>
					<option value="259200"'; if($timeframe==="259200"){echo 'selected="selected"';}echo'>3 days</option>
					<option value="345600"'; if($timeframe==="345600"){echo 'selected="selected"';}echo'>4 days</option>
					<option value="432000"'; if($timeframe==="432000"){echo 'selected="selected"';}echo'>5 days</option>
					<option value="518400"'; if($timeframe==="518400"){echo 'selected="selected"';}echo'>6 days</option>
					<option value="604800"'; if($timeframe==="604800"){echo 'selected="selected"';}echo'>7 days</option>
					</select>
					';
					
			echo'	</form> 
			</div>';
			//THIS CODE IS KIND OF MESSY, BUT IT BUILDS THE GALAXY TABLES, FILLS IN BLANKS AND ONLY HAS ONE QUERY!
			$result = mysql_query("SELECT system, MAX(timeupdated) AS timeupdated FROM planets WHERE galaxy='".$galaxy."' GROUP BY system");
				if($galaxy!==""){
					$currenttime = time();
					$olddata = $currenttime - $timeframe;
					$r = 1; $s = 1;
					echo '<table width="100%" class="table table-striped table-condensed" style="font-size:90%"><tbody>';
					if($result){while($system = mysql_fetch_assoc($result)){
					for($s; $s < $system['system']; $s++) {
						if($r === 1) {echo '<tr>';}
						echo"<td><a style=\"color:red !important; font-weight: bold;\" href=".$game_url."/galaxy/show?galaxy=".$galaxy."&solar_system=".$s.">".$s."</a></td>";
						if($r < 25) {$r++;} elseif($r===25) {echo'</tr>'; $r = 1;}
						}
					if(($system['timeupdated']) > ($olddata)){
						if($r === 1) {echo '<tr>';}
							echo"<td><a style=\"color:#999 !important;\" href=".$game_url."/galaxy/show?galaxy=".$galaxy."&solar_system=".$system['system'].">".$system['system']."</a></td>";
						} else {
							echo"<td><a style=\"color:red !important; font-weight: bold;\" href=".$game_url."/galaxy/show?galaxy=".$galaxy."&solar_system=".$system['system'].">".$system['system']."</a></td>";
						}
						$s++;
						if($r < 25) {$r++;} elseif($r===25) {echo'</tr>'; $r = 1;}
					} }
					for($s; $s <= 499; $s++) {
						if($r === 1) {echo '<tr>';}
						echo"<td><a style=\"color:red !important; font-weight: bold;\" href=".$game_url."/galaxy/show?galaxy=".$galaxy."&solar_system=".$s.">".$s."</a></td>";
						if($r < 25) {$r++;} elseif($r===25) {echo'</tr>'; $r = 1;}
					}	
				}
						?>
						<td></td></tr></tbody></table>
	</div>
<?php include('footinclude.php');