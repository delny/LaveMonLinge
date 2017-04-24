/**
 * Created by Utilisateur on 24/04/2017.
 */
'use strict';

angular.module('MyApp', ['BasketApp','ngRoute','ngSanitize'])
    .config(function ($routeProvider) {
        $routeProvider.when('/',{
           controller: 'BasketController'
        });
       $routeProvider.otherwise({
           redirectTo: '/'
       });
    })
    .config(function ($interpolateProvider){
        $interpolateProvider.startSymbol('{[{').endSymbol('}]}');
    });