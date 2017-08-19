'use strict';
var alsBlog = angular.module('alsBlog',
        [
            'homeCtrl',
            'tagsServices'
        ],
    function($interpolateProvider){
        $interpolateProvider.startSymbol('[[');
        $interpolateProvider.endSymbol(']]');
    }).
    run(function($http) {
        $http.defaults.headers.common.Accept = 'application/json'
    });