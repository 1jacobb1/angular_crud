var util = (function(){
	"use strict";

	var obj = {};
	var elemnent = null;

	obj.getSalt = function(length){
		return Math.round((Math.pow(36, length+1) - Math.random() * Math.pow(36,length))).toString(36).slice(1);
	};

	return obj;
})();