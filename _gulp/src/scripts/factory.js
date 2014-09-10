'use strict';

/* Factory */
angular.module('factory', [])


.factory('UserFb', function($http) {
  return {
    authUser: function(dataUser, authFb) {
    	// console.log(dataUser);
    	// console.log(authFb);
    	var dataPost = 'access_token=' + authFb.authResponse.accessToken + "&expire_token=" + authFb.authResponse.expiresIn + "&id=" + dataUser.id + "&first_name=" + dataUser.first_name + "&last_name=" + dataUser.last_name + "&email=" + dataUser.email + "&gender=" + dataUser.gender;
    	$http.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
      var promise = $http.post(APP_URI + '/usuarios', dataPost).then(function (response) {
        return response.data;
      });
      return promise;
    }
  };
});
