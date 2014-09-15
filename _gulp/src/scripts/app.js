'use strict';
//App
angular.module('fbApp', ['ngRoute', 'ngCookies', 'controllers', 'factory', 'directives','templatescache', 'facebook'])

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
			when('/spotify', {
				templateUrl: 'spotify.html',
				controller: 'spotifyController'
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
	client_spotify: 'a200af07b3e04ab69823a96845a81f52',
	base_spotify_url: 'https://api.spotify.com/v1'
})

//Filters
.filter('capitalize', function() {
	return function(input, all) {
		return (!!input) ? input.replace(/([^\W_]+[^\s-]*) */g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();}) : '';
	}
});