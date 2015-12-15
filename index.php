<?php 
//INCLUDE THE CONFIGURATION / CONNECT TO DATABASE
include('config.php'); 

//BUILD THE PAGE
include('headinclude.php'); 
include('navigation.php');

//BASE HOMEPAGE OR UNI HOME PAGE
if ($is_uni === 'null'){ ?>
	<div class="accordion well" id="accordion2">
        <div class="accordion-group">
			<div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne"><h1>Welcome to Open Parser</h1></a>
            </div>
            <div id="collapseOne" class="accordion-body in collapse" style="height: auto; ">
                <div class="accordion-inner">
					<p>Open Parser is a Galaxy Parser for all <a href="http://nova.playstarfleet.com" target="_blank">Starfleet Commander</a> and <a href="http://www.stardriftempires.com" target="_blank">Stardrift Empires</a> Universes and is based on code by Lytjohan and Eljer. It was written by Matt Hirschfelt with assistance from Eljer, Lytjohan, and FatBuddha. This parser, while created and maintained by Matt Hirschfelt, is not an official Blue Frog Gaming product. As such, use is at your own risk and Blue Frog Gaming will be unable to assist you should the parser interfere with your game play or if the parser stops working.</p>
				</div>
            </div>
        </div>
        <div class="accordion-group">
            <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo"><h1>What does the script do?</h1></a>
            </div>
            <div id="collapseTwo" class="accordion-body collapse" style="height: 0px; ">
                <div class="accordion-inner">
					<p>By installing this script you will automatically and unobtrusively send the data from the galaxy screen in each of the Starfleet Commander and Stardrift Empires Universes to our databases as you play the game as normal. (Data from systems in which you have planets or a Heph/Titan is not parsed.) This information is then stored in the database and is accessible from your galaxy screen.</p>
					<p>By clicking on the O! next to the player's name you will be taken to the main database with the players planets listed for you. You can then view tracking information for all of the player's planets, perform further searches by player name or alliance, and access other resources available.</p>
					<p>By clicking on the (?) in the actions area you will open up a popup within the game window which will contain all the coordinates known for that person you are searching for. All the coordinates are clickable and will take you there, useful for checking if a target is online.</p><div align="center"><img src="./assets/img/coordsexample.png"></div><br /><p>If using this feature on an "Unavailable" slot, the script will attempt to determine the last occupant of the spot and list their location and roaming planet history.</p>
                </div>
            </div>
		</div>
		<div class="accordion-group">
			<div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree"><h1>Download the Parser</h1></a>
            </div>
            <div id="collapseThree" class="accordion-body collapse" style="height: 0px; ">
                <div class="accordion-inner">
					<p>Unlike many other parsers available for Starfleet Commander and Stardrift Empires, Open Parser only requires one script for all of the Universes. Once the script is installed, make sure it is enabled. After that, there is nothing further for you do. Open Parser will attempt to automatically notify you if an update becomes available.</p>
					<div align="center">
						<a href="http://siteurl.com/open_parser.user.js" class="btn btn-primary btn-large">Download Here</a>
					</div><br />
					<p>If you are having trouble installing the parser, please see our Frequently Asked Questions.</p>
                </div>
            </div>
        </div>
		<div class="accordion-group">
            <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseFour"><h1>Tracking Information</h1></a>
            </div>
            <div id="collapseFour" class="accordion-body collapse" style="height: 0px; ">
                <div class="accordion-inner">
					<p>Tracking works by looking for activity on a player's planet every time you scan a system. It then adds a number, either 10 for activity within the last 15 minutes, 5 for activity within the last 16 to 59 minutes, or 1 if no activity is detected. This number is then assigned to that player&rsquo;s colony for the hour that you parsed. This number is increased each time the system is parsed.</p>
					<p>The cumulative number is then divided by the number of times the planet has been scanned. If for 3 days in a row you scanned 1:1:1 during the 10:00TUC hour you would get the following:
					</p>
					<div align="center">
						<table>
							<tbody><tr>
								<td>Day 1</td>
								<td>&nbsp;&nbsp;</td>
								<td>Day 2</td>
								<td>&nbsp;&nbsp;</td>
								<td>Day 3</td>
								<td>&nbsp;&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td>(*)</td>
								<td>&nbsp;&nbsp;</td>
								<td>(15 min)</td>
								<td>&nbsp;&nbsp;</td>
								<td><em>No Activity</em></td>
								<td>&nbsp;&nbsp;</td>
								<td>Total</td>
							</tr>
							<tr>
								<td>10</td>
								<td>&nbsp;&nbsp;</td>
								<td>5</td>
								<td>&nbsp;&nbsp;</td>
								<td>1</td>
								<td>&nbsp;&nbsp;</td>
								<td> 16 / 3 = 5.3</td>
							</tr></tbody>
						</table>
					</div>
					<br />
					<p>So this player during the 10:00UTC is more likely than not to be online at that time. The more times the system is parsed, the more accurate the output is like to be. When viewing this data through our website it is color coded from green (1) to red (10). In short, the higher the number between 1 and 10, the more likely a player is to be online or showing activity during that hour.</p>
                </div>
            </div>
        </div>
		<div class="accordion-group">
            <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseFive">
                  <h1>Frequently Asked Questions</h1>
                </a>
            </div>
			<div id="collapseFive" class="accordion-body collapse" style="height: 0px; ">
				<div class="accordion-inner">
					<h2>How do I install the parser with chrome?</h2>
					<p><a href="http://siteurl.com/open_parser.user.js">Download Open Parser</a> to your computer. Once downloaded you will need to drag the file from the location you downloaded it to on to your Extensions page. When you drop it on to the Extensions page you will be prompted to install the script. Click Add and you are ready to start browsing the galaxies and using the database.</p>
					<div align="center">
						<img src="./assets/img/chrome.jpg">
					</div><br />
					<p>As an alternative, you can download <a href="https://www.google.com/url?sa=t&rct=j&q=&esrc=s&source=web&cd=1&cad=rja&ved=0CCMQFjAA&url=https%3A%2F%2Fchrome.google.com%2Fwebstore%2Fdetail%2Fdhdgffkkebhmkfjojejmpbldmpobfkfo&ei=T3lTUIOFOMrZ0QHtk4HwCA&usg=AFQjCNEuGCaEhQdMnXMXtVoDxwgeZKrxqw&sig2=if87f4k_VqMwyAck6tQzsw" target="_blank">Tampermonkey</a> from the Chrome Web Store. Installation is then similar to with Firefox.</p>
					<br />
					<h2>How do I install the parser with Firefox?</h2>
					<p>To use the parser with Firefox you need to first install <a href="https://addons.mozilla.org/en-US/firefox/addon/greasemonkey/">GreaseMonkey</a> as this is what allows userscripts to run on Firefox. Once you have installed GreaseMonkey, <a href="http://siteurl.com/open_parser.user.js">download Open Parser</a>. You will then also be prompted to install the script as shown below. Once installed you are ready to start browsing the galaxies and using the database.</p>
					<div align="center">
						<img src="./assets/img/firefox.jpg">
					</div>
					<br />
					<h2>How do I install a userscript with Internet Explorer?</h2>
					<p>Very short answer - you can&rsquo;t. We recommend you either download Chrome or Firefox as their functionality allows the use of userscripts.</p>
                </div>
            </div>
        </div>
		<div class="accordion-group">
            <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseSix">
                  <h1>What if I need help?</h1>
                </a>
            </div>
			<div id="collapseSix" class="accordion-body collapse" style="height: 0px; ">
				<div class="accordion-inner">
					<p>Matt is available on Skype at <a href="skype:MattH_BFG?chat">MattH_BFG</a> or by e-mail at <a href="mailto:matt@openparser.com">matt@openparaser.com</a>.</p>

                </div>
            </div>
        </div>
    </div> <? } else { 
//GET URL VARIABLES FROM URL AND SET OTHER VARIABLES
$currentplanet = mysql_real_escape_string($_GET['cp']);

//LETS DO SOME SEARCHING!
$planets = mysql_query("SELECT COUNT(planet) AS planetcount FROM planets");
if($planets) {$row = mysql_fetch_assoc($planets);
$planetcount = $row['planetcount'];}
$players = mysql_query("SELECT COUNT(DISTINCT player) AS playercount FROM planets");
if($players){$row1 = mysql_fetch_assoc($players);
$playercount = $row1['playercount'];}
$heph = mysql_query("SELECT * FROM planets WHERE slot LIKE '%h' ORDER BY timeupdated DESC LIMIT 25");
if($heph){$hephcount = mysql_num_rows($heph);}
$enc = mysql_query("SELECT * FROM planets WHERE slot LIKE '%e' AND player NOT LIKE 'territory' ORDER BY timeupdated DESC LIMIT 25");
if($enc){$enccount = mysql_num_rows($enc);} ?>

<div class="well">
				<h1><?php echo $site_title; ?></h1>
				<p>Currently tracking <?php echo number_format($planetcount); ?> planets, moons, <?php if($is_uni === 'sde' || $is_uni === 'sden'){echo 'Titans';} else {echo 'Hephs';} ?>, and encounters amongst <?php echo number_format($playercount); ?> players and NPCs!</p><br />
							
				<div class="form-search" style="text-align:center;">
					<h2>Should we search for something?</h2>
							<form action="search.php" method="get">
							<input type="text" class="input-xxlarge" title="Search Box" name="query" id="query"><input type="submit" value="Search" class="inputTextBtn" onclick="check(this.form); return false;" ><br />
							<p><input type="radio" name="search" value="p" style="vertical-align:top" checked>&nbsp;Player Name&nbsp;&nbsp;&nbsp;or&nbsp;&nbsp;&nbsp;<input type="radio" name="search" value="a" style="vertical-align:top">&nbsp;Alliance Tag&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="exact" value="true" style="vertical-align:top" checked>&nbsp;Exact Search&nbsp;&nbsp;&nbsp;or&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="exact" value="false" style="vertical-align:top">&nbsp;Begins With</p>
							</form><br />
					</div>
				<div style="width:49%; margin-right:5px; float:left;">
				<div style="width:75%; margin: 0 auto; text-align: center;"><?php if($hephcount === 0){echo '<h3>No'; if($is_uni === 'sde' || $is_uni === 'sden'){echo ' Titans ';} else {echo ' Hephs ';}echo'Seen';} else {echo'<h3>Latest '.$hephcount; if($is_uni === 'sde' || $is_uni === 'sden'){echo ' Titans ';} else {echo ' Hephs ';} echo'Seen'; if($hephcount === 25){echo ' (<a href="/search.php?cp='.$currentplanet.'&search=h">See More</a>)';}}?></h3></div>
				<table width="100%" class="table-striped" style="font-size:90%">
								<thead><tr>
									<th align="left">Player</th>
									<th align="left">Coordinates</th>
									<th align="right" >Time Added</th>
								</tr></thead><tbody>
							<?php if($heph){while($hephdata = mysql_fetch_assoc($heph)){ 
							echo "
							<tr>
								<td style=\"height:23px\"><span style=\"display: inline-block;overflow: hidden;white-space: nowrap;width: 216px;\"><a href=\"search.php?cp=".$currentplanet."&search=p&exact=true&query=".$hephdata['player']."\">".stripslashes($hephdata['player'])."</a>";
								if(preg_match('[h]', $hephdata['slot'])) { 
									 echo '<img src="assets/img/';if($is_uni === 'sde' || $is_uni === 'sden'){echo'sde';} else{echo'sfc';}echo'_roaming_planet.png" border="0" style="padding-left:15px;height:16px;width:16px">';}
								if($hephdata['status'] !== ""){echo "<span style=\"font-size:80% !important;\"'>&nbsp;(".$hephdata['status'].")&nbsp;</span>";}
							echo "</span></td>";
							echo "<td><a href=".$game_url."/galaxy/show?current_planet=".$currentplanet."&galaxy=".$hephdata['galaxy']."&solar_system=".$hephdata['system'].">[".$hephdata['galaxy'].":".$hephdata['system'].":".$hephdata['slot']."]</a></span></td>";
							echo "<td align=\"right\">".date("m-d-Y H:i",$hephdata['timeupdated'])."</td>";
							}}
							echo "</tr></tbody></table><br />"; 
							?>
				</div>
				<div style="width:49%;  margin-left:5px;  float:right;">
				<div style="width:75%; margin: 0 auto; text-align: center;"><h3>Latest <?php echo $enccount;?> Encounters Seen <?php if($enccount === 25){echo ' (<a href="viewencounters.php">Find More</a>)';}?></h3></div>
				<table width="100%" class="table-striped" style="font-size:90%">
								<thead><tr>
									<th align="left">Encounter</th>
									<th align="left">Coordinates</th>
									<th align="right" >Time Added</th>
								</tr></thead><tbody>
							<?php if($enc){while($encdata = mysql_fetch_assoc($enc)){ 
							echo "
							<tr>
								<td style=\"height:23px\"><span style=\"display: inline-block;overflow: hidden;white-space: nowrap;width: 216px;\">".stripslashes($encdata['planet'])."</span></td>
								<td><a href=".$game_url."/galaxy/show?current_planet=".$currentplanet."&galaxy=".$encdata['galaxy']."&solar_system=".$encdata['system'].">[".$encdata['galaxy'].":".$encdata['system'].":".$encdata['slot']."]</a></span></td>
								<td align=\"right\">".date("m-d-Y H:i",$encdata['timeupdated'])."</td>";
							}}
							echo "</tr></tbody></table><br />"; 
							?>
				</div>
				<div style="clear:both"></div>
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
	<?php }
include('footinclude.php');