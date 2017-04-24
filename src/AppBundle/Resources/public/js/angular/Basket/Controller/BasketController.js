/**
 * Created by Utilisateur on 24/04/2017.
 */
'use strict';

angular.module('BasketApp')
    .controller('BasketController',[
        '$scope',
        '$http',
        'PanierService',
        function ($scope,$http,PanierService){
            $scope.basket = PanierService.getPanier();

            $scope.getHTPrice = function(produit) {
                return PanierService.getPriceHT(produit.reference);
            };
            $scope.getTTCPrice = function(produit){
                return PanierService.getPriceTTC(produit.reference);
            };
            $scope.getTotalHT = function(){
                return PanierService.getTotalHT();
            };
            $scope.getTotalTTC = function() {
                return PanierService.getTotalTTC();
            };

            PanierService.getList().then(function (data) {
                for (var product in data) {
                    PanierService.addPanier(product);
                }
            })
        }]);