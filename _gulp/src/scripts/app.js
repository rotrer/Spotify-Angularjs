'use strict';
//App
angular.module('fbApp', ['ngRoute', 'controllers', 'factory', 'directives','templatescache', 'facebook'])

.config(['$routeProvider',
	function($routeProvider) {
		$routeProvider.
			when('/home', {
				templateUrl: 'home.html',
				controller: 'homeController'
			}).
			when('/register', {
				templateUrl: 'register.html',
				controller: 'registerController'
			}).
			otherwise({
				redirectTo: '/home'
			});
}])

.config(function(FacebookProvider) {
   // Set your appId through the setAppId method or
   // use the shortcut in the initialize method directly.
   FacebookProvider.init(appId);
})

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