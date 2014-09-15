'use strict';

/* Factory */
angular.module('factory', [])


.factory('UserFb', function($http) {
  return {
    authUser: function(dataUser, authFb) {
    	var dataPost = "access_token=" + authFb.authResponse.accessToken + 
    								 "&expire_token=" + authFb.authResponse.expiresIn + 
    								 "&id=" + dataUser.id + 
    								 "&first_name=" + dataUser.first_name + 
    								 "&last_name=" + dataUser.last_name + 
    								 "&email=" + dataUser.email + 
    								 "&gender=" + dataUser.gender +
    								 "&link=" + dataUser.link +
    								 "&locale=" + dataUser.locale +
    								 "&name=" + dataUser.name +
    								 "&timezone=" + dataUser.timezone +
    								 "&updated_time=" + dataUser.updated_time +
    								 "&username=" + dataUser.username +
    								 "&username=" + dataUser.username;

    	$http.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
      var promise = $http.post(APP_URI + '/usuarios', dataPost).then(function (response) {
        return response.data;
      });
      return promise;
    }
  };
})

.factory('spotifySearch', function($http, dataApp) {
  return {
    getTrack: function(txtTrack) {
      var url = dataApp.base_spotify_url + '/search?q=' + encodeURIComponent(txtTrack)  +'&type=track';
      var promise = $http.get(url).then(function (response) {
        return response.data;
      });
      return promise;
    }
  };
})
