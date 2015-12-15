// ==UserScript==
// @name          Open Parser
// @description   Autoupload every galaxy screen you see in any version of Starfleet Commander or Stardrift Empires!
// @include       *stardriftempires.com/galaxy*
// @include		  *stardriftempires.syfygames.com/galaxy*
// @include       *playstarfleet.com/galaxy*
// @include       *playstarfleetextreme.com/galaxy*
// @version       1.0.5
// ==/UserScript==
// Thanks to Lytjohan and Eljer for letting me base this off their userscripts and Rob for help in writing more compressed code!

(function(){

	//VERSION INFO
	var version = "1.0.8";
	
	//SET UPLOAD PATH BASED ON GAME!
	var servers = {
		"stardriftempires.com":"sde.siteurl.com",
		"fb.stardriftempires.com":"sde.siteurl.com",
		"ssl.fb.stardriftempires.com":"sde.siteurl.com",
		"stardriftempires.syfygames.com":"sde.siteurl.com",
		"kong.stardriftempires.com":"sde.siteurl.com",
		"playstarfleet.com":"sfo.siteurl.com",
		"fb.playstarfleet.com":"sfo.siteurl.com",
		"ssl.fb.playstarfleet.com":"sfo.siteurl.com",
		"uni2.playstarfleet.com":"uni2.siteurl.com",
		"fb.uni2.playstarfleet.com":"uni2.siteurl.com",
		"ssl.fb.uni2.playstarfleet.com":"uni2.siteurl.com",
		"playstarfleetextreme.com":"x1.siteurl.com",
		"fb.playstarfleetextreme.com":"x1.siteurl.com",
		"ssl.fb.playstarfleetextreme.com":"x1.siteurl.com",
		"uni2.playstarfleetextreme.com":"x2.siteurl.com",
		"fb.uni2.playstarfleetextreme.com":"x2.siteurl.com",
		"ssl.fb.uni2.playstarfleetextreme.com":"x2.siteurl.com",
		"nova.playstarfleet.com":"nova.siteurl.com",
		"fb.nova.playstarfleet.com":"nova.siteurl.com",
		"ssl.fb.nova.playstarfleet.com":"nova.siteurl.com",
		"tournament.playstarfleet.com":"tournament.siteurl.com",
		"fb.tournament.playstarfleet.com":"tournament.siteurl.com",
		"ssl.fb.tournament.playstarfleet.com":"tournament.siteurl.com",
		"nova.stardriftempires.com":"sdenova.siteurl.com",
		"fb.nova.stardriftempires.com":"sdenova.siteurl.com",
		"ssl.fb.nova.stardriftempires.com":"sdenova.siteurl.com",
		"conquest.playstarfleet.com":"conquest.siteurl.com",
		"fb.conquest.playstarfleet.com":"conquest.siteurl.com",
		"ssl.fb.conquest.playstarfleet.com":"conquest.siteurl.com",
		"guns.playstarfleet.com":"guns.siteurl.com",
		"fb.guns.playstarfleet.com":"guns.siteurl.com",
		"ssl.fb.guns.playstarfleet.com":"guns.siteurl.com",	
		"uni3.playstarfleet.com":"uni3.siteurl.com",
		"fb.uni3.playstarfleet.com":"uni3.siteurl.com",
		"ssl.fb.uni3.playstarfleet.com":"uni3.siteurl.com",	
		"eradeon.playstarfleet.com":"eradeon.siteurl.com",
		"fb.eradeon.playstarfleet.com":"eradeon.siteurl.com",
		"ssl.fb.eradeon.playstarfleet.com":"eradeon.siteurl.com",	
		"eradeon2.playstarfleet.com":"eradeon2.siteurl.com",
		"fb.eradeon2.playstarfleet.com":"eradeon2.siteurl.com",
		"ssl.fb.eradeon2.playstarfleet.com":"eradeon2.siteurl.com",
		"eradeon3.playstarfleet.com":"eradeon3.siteurl.com",
		"fb.eradeon3.playstarfleet.com":"eradeon3.siteurl.com",
		"ssl.fb.eradeon3.playstarfleet.com":"eradeon3.siteurl.com",
		"conquest2.playstarfleet.com":"conquest2.siteurl.com",
		"fb.conquest2.playstarfleet.com":"conquest2.siteurl.com",
		"ssl.fb.conquest2.playstarfleet.com":"conquest2.siteurl.com",
	};
	var domain = servers[window.location.hostname];
	if(!domain)return;
	var path_to_upload = "http://"+domain+"/listener.php";
	var search_path = "http://"+domain+"/search.php";
	var galaxy_search = "http://"+domain+"/galaxyfeedback.php";

	//SET COUNTERS FOR PARAMATERS PURPOSES AND STRING TO APPEND TO
	var y = "1";
	var string1="";
	var string2="";
	
	//SET TIME IN UNIX FORMAT
	var timedate = Math.round(+new Date()/1000);
	
	//WHAT IS OUR CURRENT PLANET SO WE CAN GET BACK HERE
	var activate_p = document.URL.match(/activate_planet=([0-9]*)/);
	var current_p = document.URL.match(/current_planet=([0-9]*)/);
	
	if (activate_p) {
		planet_id = activate_p[1];
	} else if (current_p) {
		planet_id = current_p[1];
	} else {
		planet_id = 0;
		}
	
	//SET GALAXY AND SYSTEM SO WE KNOW WHERE WE ARE
	var galaxy=document.getElementById('galaxy').getAttribute('value');
	var system=document.getElementById('solar_system').getAttribute('value');
	
	//SET THE TABLE ROWS WE'RE GOING TO TRANSVERSE
	var vTRs=document.getElementById('planets').getElementsByTagName('tr');
	
	//IS THIS OUR GALAXY?
	var ownsystem = document.querySelector(".own");
	if(ownsystem) {document.querySelector(".colonized_planets").innerHTML+=" - Open Parser: <span style='color: blue;'>NOT PARSED</span>.";}
	
	//LET'S LOOP THROUGH THE TABLE
	if(!ownsystem){
	for (i=1;i<vTRs.length;i++) {
	
		//IS THIS A PLAYER OR NPC?
		if (vTRs[i].querySelector(".player .not_attackable, .player .attackable") != null) {
			var vPlayer=vTRs[i].querySelector(".player .not_attackable, .player .attackable");
		} else {
			var vPlayer=vTRs[i].querySelector(".player");
		}
		
		//WAS THERE A PLAYER OR NPC IN THE SLOT? IF NO OR SELF, SKIP IT!
		if (vPlayer!=null) {
		if (vPlayer.innerHTML.replace(/^\s+|\s+$/g, "").length>0) { 
						
			//WHAT SLOT ARE WE IN?
			var slot=vTRs[i].getAttribute('id').substr(7);
			
			//IS IT A HEPH?
			if (vTRs[i].querySelector(".name").getElementsByTagName('img')[0] != null) {
				slot+='h'; 
			}
						
			//WHAT IS THE PLANET NAME?
			if (vTRs[i].querySelector(".name .attackable, .name .not_attackable") !=null) {
				var planetNameEl = vTRs[i].querySelector(".name .attackable, .name .not_attackable");
				var planetName = planetNameEl.textContent.trim();
			} else {
				var planetNameEl = vTRs[i].querySelector(".name");
				var planetName = planetNameEl.textContent.trim();
			}	
					
			//WAS THERE ACTIVITY ON THE PLANET?
			var planetActivity = "";
			if (vTRs[i].querySelector(".activity")!=null) {
				planetActivity=vTRs[i].querySelector(".activity").innerHTML;
			}
			
			//WHAT IS THE PLAYER RANK?
			var rank='';
			if(vPlayer.getElementsByTagName('span').length>0) {
				var rank=vPlayer.getElementsByTagName('span')[vPlayer.getElementsByTagName('span').length-1].innerHTML.replace(/^\s+|\s+$/g, "").substr(1).replace(/,/g,'');  
			}
			
			//WHAT IS THE PLAYER NAME?
			if(vTRs[i].querySelector(".player .not_attackable, .player .attackable") !=null){
				var playername = vTRs[i].querySelector(".player .not_attackable, .player .attackable").getElementsByTagName("a")[1].textContent.trim().replace('\u200E','');
			} else {
				var playername = vTRs[i].querySelector(".player").innerHTML.replace(/<span[^>]*?>[\s\S]*?<\/span>/gi, '').replace(/<button[^>]*?>[\s\S]*?<\/button>/gi, '').trim();
			}
								
			//WHAT IS THE PLAYER STATUS?
			var statsymbol='';
			if(vTRs[i].querySelector(".status .symbols")!=null) {
				var statsymbol=vTRs[i].querySelector(".symbols").textContent.trim();
			}
			
			//IS THE PLAYER IN AN ALLIANCE? IF SO, WHICH ONE?
			var alliance='';
			if(vTRs[i].querySelector(".alliance .attackable, .alliance .not_attackable")!=null) {
				var alliance=vTRs[i].querySelector(".alliance .attackable, .alliance .not_attackable").textContent.trim();
			}
			
			//BUILD THE URL STRING AND SPLIT IF TOO LONG
			var temp = [slot, playername, statsymbol, alliance, rank, planetName, planetActivity];
			for(var j=0; j<temp.length; ++j){
				temp[j] = "v"+y+""+j+"="+encodeURIComponent(temp[j]);
			}
			
			temp = temp.join("&");
			string1 += "&" + temp;
			}
		} 
	
	//INCREASE VARIABLES FOR NEXT PARAMETERS
	y++;
	}
	
	//PREPARE STRING TO SEND!	
	var urlstring = "info=" + version + "&g=" + galaxy + "&s=" + system + "&t=" + timedate + string1.replace(/,undefined/,"");
	
	//LET'S SUBMIT THOSE STRINGS!	
	try {
        try {
            //LET'S TRY FOR FIREFOX FIRST!
            GM_xmlhttpRequest({
                method: 'POST',
                url: path_to_upload,
                headers: {
					"Content-Type": "application/x-www-form-urlencoded"
				},
                data: urlstring,
                onload: function(response) {
                 if(response.status == 200) {
					document.querySelector(".colonized_planets").innerHTML+=" - Open Parser: <span style='color: rgb(10, 255, 10);'>PARSED</span>.";
					} else if (response.status == 405) {
						showAdvisory("http://"+domain+"/open_parser.user.js", "<br />Open Parser Update Required. Click here to update now.");
						document.querySelector(".colonized_planets").innerHTML+=" - Open Parser: <span style='color: red;'>NOT PARSED</span>.";
					} else if (response.status == 412) {
						document.querySelector(".colonized_planets").innerHTML+=" - Open Parser: <span style='color: blue;'>PARSED</span>.";
					}
                }
            });
        }
        catch (e) {
	//NOT FIREFOX? GOOD. LET'S TRY THE NORMAL WAY NOW.
		try {
			var req = new XMLHttpRequest();
			req.open('POST', path_to_upload, true);
			req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			req.onreadystatechange = function() {
				if(req.readyState == 4 && req.status == 200) {
					document.querySelector(".colonized_planets").innerHTML+=" - Open Parser: <span style='color: rgb(10, 255, 10);'>PARSED</span>.";
				} else if (req.readyState == 4 && req.status == 405) {
						showAdvisory("http://"+domain+"/open_parser.user.js", "<br />Open Parser Update Required. Click here to update now.");
						document.querySelector(".colonized_planets").innerHTML+=" - Open Parser: <span style='color: red;'>NOT PARSED</span>.";
				} else if (req.readyState == 4 && req.status == 412) {
						document.querySelector(".colonized_planets").innerHTML+=" - Open Parser: <span style='color: blue;'>PARSED</span>.";
				}
			}
			req.send(urlstring);
		} catch (e) {
			document.querySelector(".colonized_planets").innerHTML+=" - Open Parser: <span style='color: red;'>NOT PARSED</span>.";
		}
		} 
	} catch (e) {
        document.querySelector(".colonized_planets").innerHTML+=" - Open Parser: <span style='color: red;'>NOT PARSED</span>.";
    }
		
	//CREATE WARNING BOX IF UPDATE NEEDED
	function showAdvisory(url, title) {
		var el = document.getElementById("sticky_notices");
		var div = document.createElement("div");
		var span = document.createElement("span");
		var a = document.createElement("a");
		div.setAttribute("class", "notice");
		span.setAttribute("class", "notice_icon");
		div.appendChild(span);
		a.setAttribute("href", url);
		a.innerHTML = title;
		div.appendChild(a);
		el.appendChild(div);
	}
	
}	

	//INJECT SOME FORMATTING IN TO THE PAGE TO MAKE THE ? WORK!
	function injectscriptJs() {
		var d = document;
		var scr = d.createElement('script');
		scr.type = "text/javascript";
		scr.src = 'http://siteurl.com/open_parser_server.js';
		d.getElementsByTagName('head')[0].appendChild(scr);
	}
	
	injectscriptJs()

	//PUT O! and ? IN GALAXY
	for (i=1;i<vTRs.length;i++) {
		if (vTRs[i].querySelector(".own .player .not_attackable") !=null) {
			var playername = vTRs[i].querySelector(".player .not_attackable").textContent.replace(/#[\d,]*/g, "").trim().replace('\u200E','');
			vTRs[i].querySelector(".player .not_attackable, .player .attackable").innerHTML += "<a href='" + search_path + "?cp=" + planet_id + "&search=p&exact=true&query=" + encodeURIComponent(playername).replace(/!/g, '%21').replace(/'/g, '%27').replace(/\(/g, '%28').replace(/\)/g, '%29').replace(/\*/g, '%2A') + "' target='_blank'>O!</a>";
			vTRs[i].querySelector(".actions").innerHTML += "<a href='javascript:void(0);' onclick=setPos(this);getColString('" + galaxy_search + "?req=galsearch&g=" + galaxy + "&s=" + system + "&slot=" + slot + "&player=" + encodeURIComponent(playername).replace(/!/g, '%21').replace(/'/g, '%27').replace(/\(/g, '%28').replace(/\)/g, '%29').replace(/\*/g, '%2A') + "&cp=" + planet_id + "');> ? </a>";
		} else if (vTRs[i].querySelector(".player .not_attackable, .player .attackable") != null) {
			var playername = vTRs[i].querySelector(".player .not_attackable, .player .attackable").getElementsByTagName("a")[1].textContent.trim().replace('\u200E','');
			vTRs[i].querySelector(".player .not_attackable, .player .attackable").innerHTML += "<a href='" + search_path + "?cp=" + planet_id + "&search=p&exact=true&query=" + encodeURIComponent(playername).replace(/!/g, '%21').replace(/'/g, '%27').replace(/\(/g, '%28').replace(/\)/g, '%29').replace(/\*/g, '%2A') + "' target='_blank'>O!</a>";
			vTRs[i].querySelector(".actions").innerHTML += "<a href='javascript:void(0);' onclick=setPos(this);getColString('" + galaxy_search + "?req=playersearch&player=" + encodeURIComponent(playername).replace(/!/g, '%21').replace(/'/g, '%27').replace(/\(/g, '%28').replace(/\)/g, '%29').replace(/\*/g, '%2A') + "&cp=" + planet_id + "');> ? </a>";
		} else if(vTRs[i].querySelector(".name") != null) {
			if (vTRs[i].querySelector(".name").textContent.trim() == "Unavailable") {
				slot = vTRs[i].querySelector(".slot").textContent.trim();
			vTRs[i].querySelector(".actions").innerHTML += "<a href='javascript:void(0);' onclick=setPos(this);getColString('" + galaxy_search + "?req=hephsearch&g=" + galaxy + "&s=" + system + "&slot=" + slot + "&cp=" + planet_id + "');> ? </a>";
			}
			}
	}	
	

})();