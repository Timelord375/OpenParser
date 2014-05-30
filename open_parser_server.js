// ==UserScript==
// @name          Open Parser Server Stuff!
// @description   Autoupload every galaxy screen you see in any version of Starfleet Commander or Stardrift Empires!
// @include       *stardriftempires.com/galaxy*
// @include		  *stardriftempires.syfygames.com/galaxy*
// @include       *playstarfleet.com/galaxy*
// @include       *playstarfleetextreme.com/galaxy*
// @version       0.0.1
// ==/UserScript==
// Thanks to Lytjohan and Eljer for letting me base this off their userscripts and Rob for help in writing more compressed code!


	v1 = 0;
	v2 = 0;
	var view;
	function setPos(el) {
		var v = findPos(el);
		v1 = v[0];
		v2 = v[1];
	}

	function findPos(obj) {
		var curleft = curtop = 0;
		if (obj.offsetParent) {
			do {
				curleft += obj.offsetLeft;
				curtop += obj.offsetTop;
			} while (obj = obj.offsetParent);
		}
		return [curleft,curtop];
	}

	function removeResult(e) {

		var targ;
		if (!e) var e = window.event;
		if (e.target) targ = e.target;
		else if (e.srcElement) targ = e.srcElement;
		if (targ.nodeType == 3) // defeat Safari bug
			targ = targ.parentNode;

		if (targ.tagName == "A") // Moz
			return;

		if (view != null) {
			document.body.removeEventListener('click', removeResult, true);
			document.body.removeChild(view);
			view = null;
		}
	}

	function showResult(str) {

		if (view != null) {
			removeResult();
		}
		view = document.createElement("div");
		view.setAttribute("id", "intelpop");
		view.setAttribute("style", "padding:10px;font-size:90%;font-family:tahoma;position:absolute;left:" + v1 + "px;top:" + v2 + "px;background-color:black;border:1px solid #a5a5a5;");
		view.innerHTML = str;
		
		document.body.appendChild(view);
		document.body.addEventListener('click', removeResult, true);

		// move it to the left of the ?
		document.getElementById('intelpop').style.left = (v1 - document.getElementById('intelpop').offsetWidth) + "px";
	}
	
	function getColString(urlToSend) {
		var req = false;
		if (window.XMLHttpRequest) {
			try { req = new XMLHttpRequest(); } catch (e) { req = false; }
		} else {
			alert('no window.xmlhttprequest');
		}
		if (req) {
			req.open('GET', urlToSend, false);
			req.onload = function () {
				if (req.status == 200) {
					if (req.status == 200) {  showResult(req.responseText); }
					else { obj = false; }
				} else { obj = false; }
			}
			req.send();
		} else { obj = false; }
	}
