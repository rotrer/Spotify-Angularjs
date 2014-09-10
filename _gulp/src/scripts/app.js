'use strict';
// Ionic App
angular.module('APP_NAME', ['controllers', 'factory', 'directives'])

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