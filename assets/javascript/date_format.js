// JavaScript Document
/**
 * SightWorks date formatting method. Formats are the same as provided to PHP's date() function.
 *
 * (c) 2007-2010 SightWorks, Inc. All rights reserved.
 */

(function() {
	var API = null, P = null;

	var mnames = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ];
	var isLocalized = false;

	
	Date.prototype.format = function(str) {
		var output = [];
		function pad(c, s, l) {
			s = String(s);
			while (s.length < l)
				s = c + s;
			return s;
		}
		// Yup, this function only works with English. That will have to be looked into at some point.
		var dnames = [ "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday" ];
	
		if (!isLocalized) {
			try {
				if (!API)
					API = new Platform_API;
				if (!P)	
					P = API.getPlugin('com.sightworks.platform.i18n').Instance;
				for (var i = 0; i < mnames.length; i++)
					mnames[i] = P.localizeString(mnames[i]);
			} catch (e) {
				try {
					// debug (e);
				} catch (e2) {
					;
				}
			}
			// debug (mnames);
			isLocalized = true;
		}
		
		var suffixes = {};
		suffixes[1] = "st";
		suffixes[21]= "st";
		suffixes[31]= "st";
		suffixes[2] = "nd";
		suffixes[22]= "nd";
		suffixes[3] = "rd";
		suffixes[23]= "rd";
		
		for (var i = 0; i < str.length; i++) {
			switch (str.charAt(i)) {
				case "d": output.push(pad("0", this.getDate(), 2)); break;
				case "D": output.push(dnames[this.getDay()].substring(0, 3)); break;
				case "j": output.push(this.getDate()); break;
				case "l": output.push(dnames[this.getDay()]); break;
				case "N": output.push(this.getDay() + 1); break;
				case "S": if (suffixes[this.getDate()]) output.push(suffixes[this.getDate()]); else output.push("th"); break;
				case "w": output.push(this.getDay()); break;
				case "z": 
					var d = new Date(this.getTime()); 
					d.setHours(0); 
					d.setMinutes(0);
					d.setSeconds(0);
					d.setMilliseconds(0);
					d.setMonth(0);
					d.setDate(1);
					var diff = Math.floor((this.getTime() - d.getTime()) / 86400000);
					output.push(diff);
					break;
				case "F": /* debug(this.getMonth()); */ output.push(mnames[this.getMonth()]); break;
				case "m": output.push(pad(0, this.getMonth() + 1, 2)); break;
				case "M": output.push(mnames[this.getMonth()].substring(0, 3)); break;
				case "n": output.push(this.getMonth() + 1); break;
				case "t":
					var d = new Date();
					d.setMonth(this.getMonth());
					d.setYear(this.getFullYear());
					d.setDate(0);
					output.push(d.getDate());
					break;
				case "L":
					var d = new Date();
					d.setMonth(2);
					d.setYear(this.getFullYear());
					d.setDate(0);
					output.push(d.getDate() == 29 ? "1" : "0");
					break;
				case "Y": output.push(this.getFullYear()); break;
				case "y": output.push(String(this.getFullYear()).substring(2)); break;
				case "a": output.push(this.getHours() >= 12 ? 'pm' : 'am'); break;
				case "A": output.push(this.getHours() >= 12 ? 'PM' : 'AM'); break;
				case "g": var p = this.getHours() % 12; if (p == 0) p = 12; output.push(p); break;
				case "G": output.push(this.getHours()); break;
				case "h": var p = this.getHours() % 12; if (p == 0) p = 12; output.push(pad("0", p, 2)); break;
				case "H": output.push(pad("0", this.getHours(), 2)); break;
				case "i": output.push(pad("0", this.getMinutes(), 2)); break;
				case "s": output.push(pad("0", this.getSeconds(), 2)); break;
				case "u": output.push(pad("0", this.getMilliseconds() * 100, 2)); break;
				case "r": output.push(this.format("D, d M Y H:i:s Z")); break;
				case "c": output.push(this.format("Y-m-d"), 'T', this.format('H:i:sZ')); break;
				default: output.push(str.charAt(i));
			}
		}
		return output.join("");
	}
})();

