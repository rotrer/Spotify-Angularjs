'use strict';
//App
angular.module('fbApp', ['ngRoute', 'controllers', 'factory', 'directives','templatescache'])

.config(['$routeProvider',
	function($routeProvider) {
		$routeProvider.
			when('/home', {
				templateUrl: 'home.html',
				controller: 'homeController'
			}).
			when('/test/:testId', {
				templateUrl: 'home.html',
				controller: 'homeController'
			}).
			otherwise({
				redirectTo: '/home'
			});
}])

//Constantes App
.value('dataApp', {
	endPointBase: '' 
})

//Filters
.filter('capitalize', function() {
	return function(input, all) {
		return (!!input) ? input.replace(/([^\W_]+[^\s-]*) */g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();}) : '';
	}
});