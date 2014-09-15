'use strict';

/* Controllers */
angular.module('controllers', [])

.controller('homeController', [
	'$scope',
	'$timeout',
	'$location',
	'$cookieStore',
	'Facebook',
	'UserFb',
	function($scope, $timeout, $location, $cookieStore, Facebook, UserFb) {
		// Define user empty data :/
		$scope.user = {};
		
		// Defining user logged status
		$scope.logged = false;
		
		// And some fancy flags to display messages upon user status change
		$scope.byebye = false;
		$scope.salutation = false;
		$scope.errorApi = false;
		
		/**
		 * Watch for Facebook to be ready.
		 * There's also the event that could be used
		 */
		$scope.$watch(
			function() {
				return Facebook.isReady();
			},
			function(newVal) {
				if (newVal)
					$scope.facebookReady = true;
			}
		);
		
		/**
		 * IntentLogin
		 */
		$scope.IntentLogin = function() {
			Facebook.getLoginStatus(function(response) {
				if (response.status == 'connected') {
					$scope.logged = true;
					$scope.me(response); 
				}
				else
					$scope.login();
			});
		};
		
		/**
		 * Login
		 */
		 $scope.login = function() {
			 Facebook.login(function(response) {
				if (response.status == 'connected') {
					$scope.logged = true;
					$scope.me(response);
				}
			
			});
		 };
		 
		 /**
			* me 
			*/
			$scope.me = function(authFb) {
				Facebook.api('/me', function(dataUser) {
					UserFb.authUser(dataUser, authFb).then(function(results) {
						/**
						 * Using $scope.$apply since this happens outside angular framework.
						 */
						if (results.status == 200 && results.error == "false"){
		      		$cookieStore.put('user_id', results.data.id);
		      		$cookieStore.put('token', results.data.token);
		      		$scope.user = dataUser;
							$scope.salutation = true;
							$timeout(function() {
								$location.path('/spotify');
							}, 2000);
		      	} else {
		      		$scope.errorApi = true;
		      		$scope.logged = false;
		      	}
					});
				});
			};
		
		/**
		 * Logout
		 */
		$scope.logout = function() {
			Facebook.logout(function() {
				$scope.$apply(function() {
					$scope.user   = {};
					$scope.logged = false;  
				});
			});
		}
		
		/**
		 * Taking approach of Events :D
		 */
		$scope.$on('Facebook:statusChange', function(ev, data) {
			if (data.status == 'connected') {
				$scope.$apply(function() {
					$scope.salutation = false;
					$scope.byebye     = false;    
				});
			} else {
				$scope.$apply(function() {
					$scope.salutation = false;
					$scope.byebye     = true;
					
					// Dismiss byebye message after two seconds
					$timeout(function() {
						$scope.byebye = false;
					}, 2000)
				});
			}
			
			
		});
		
		
	}
])

.controller('registerController', [
	'$scope',
	'$timeout',
	'$location',
	'$cookieStore',
	'Facebook',
	function($scope, $timeout, $location, $cookieStore, Facebook) {
		console.log($cookieStore.get('user_id'));
		console.log($cookieStore.get('token'));
		
		/**
		 * IntentLogin
		 */
		Facebook.getLoginStatus(function(response) {
			if (response.status !== 'connected') {
				$cookieStore.remove('user_id');
				$cookieStore.remove('token');
				$location.path('/home');
			}
		});
	}
])

.controller('spotifyController', [
	'$scope',
	'$timeout',
	'$location',
	'$cookieStore',
	'Facebook',
	'spotifySearch',
	'dataApp',
	function($scope, $timeout, $location, $cookieStore, Facebook, spotifySearch, dataApp) {
		/**
		 * Check Cookies
		 */
		if ($cookieStore.get('user_id') === undefined || $cookieStore.get('token') === undefined) {
			$location.path('/home');
		};
		/**
		 * IntentLogin
		 */
		Facebook.getLoginStatus(function(response) {
			if (response.status !== 'connected') {
				$cookieStore.remove('user_id');
				$cookieStore.remove('token');
				$location.path('/home');
			}
		});


		/**
		 * Input search
		 */
		$scope.res_search = false;
		$scope.updateSearch = function(){
			spotifySearch.getTrack( $scope.track ).then(function(results) {
				// console.log(results.tracks.items);
				$scope.res_search = true;
				$scope.listTracks = results.tracks.items;
			});
		}


		// console.log(dataApp.client_spotify);
		// console.log($cookieStore.get('user_id'));
		// console.log($cookieStore.get('token'));
		
		
	}
])






