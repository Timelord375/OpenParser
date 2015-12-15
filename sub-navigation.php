<div class="tabbable tabs-below">
		<ul class="nav nav-tabs">
			<li <?php if ($_SERVER['SCRIPT_NAME'] === '/index.php') {echo'class="active"';}?>><a href="index.php?cp=<?php echo $currentplanet; ?>">Home</a></li>
			<li <?php if ($_SERVER['SCRIPT_NAME'] === '/search.php') {echo'class="active"';}?>><a href="search.php?cp=<?php echo $currentplanet; ?>">Search</a></li>
			<li <?php if ($_SERVER['SCRIPT_NAME'] === '/missingsystems.php') {echo'class="active"';}?>><a href="missingsystems.php?cp=<?php echo $currentplanet; ?>">Missing Systems</a></li>
			<?php if($is_uni !== 'guns'){echo'<li '; if ($_SERVER['SCRIPT_NAME'] === '/viewmoons.php') {echo'class="active"';} echo'>'?><a href="viewmoons.php?cp=<?php echo $currentplanet; ?>">Moon Overview</a></li><?php };?>
			<li <?php if ($_SERVER['SCRIPT_NAME'] === '/viewencounters.php') {echo'class="active"';}?>><a href="viewencounters.php?cp=<?php echo $currentplanet; ?>">Encounter Search</a></li>
			<?php if($is_uni === 'guns'){echo' <li '; if ($_SERVER['SCRIPT_NAME'] === '/viewterritories.php') {echo'class="active"';}; echo'>';?><a href="viewterritories.php?cp=<?php echo $currentplanet; ?>">Territory Search</a></li><?php }; ?>
			<li <?php if ($_SERVER['SCRIPT_NAME'] === '/targetsearch.php') {echo'class="active"';}?>><a href="targetsearch.php?cp=<?php echo $currentplanet; ?>">Target Search</a></li>
		</ul>
	</div>