"use strict";
var myApp = angular.module('myApp', []);

myApp.run(['$rootScope', '$http', '$compile', function($rootScope, $http, $compile){
	$rootScope.firstName = "jacob earl";

	$rootScope.getIndex  = function(find, list){
		var idx = _.findIndex(list, find);
		return idx;
	}
}]);
