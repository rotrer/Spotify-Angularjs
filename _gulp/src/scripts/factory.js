'use strict';

/* Factory */
angular.module('factory', [])


.factory('UserFb', function($http) {
  return {
    authUser: function(dataUser, authFb) {
    	console.log(dataUser);
    	console.log(authFb);
      var promise = $http.get(APP_URI + '/usuarios').then(function (response) {
        return response.data;
      });
      return promise;
    }
  };
});
