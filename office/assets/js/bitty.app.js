var app = angular.module('bittyApp', ['ui.router', 'ui.bootstrap'])

app.config(['$qProvider', function ($qProvider) {
    $qProvider.errorOnUnhandledRejections(false);
}]);

app.run([ '$rootScope', '$state', '$stateParams', function ($rootScope, $state, $stateParams) {
	  $rootScope.$state = $state;
	  $rootScope.$stateParams = $stateParams;
}]);


