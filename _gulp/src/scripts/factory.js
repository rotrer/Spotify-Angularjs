'use strict';

/* Factory */
angular.module('factory', [])


.factory('XXXX', function($http, dataApp) {
  return {
    getAll: function(param_foo) {
      var promise = $http.get(url).then(function (response) {
        return response.data;
      });
      return promise;
    }
  };
});
