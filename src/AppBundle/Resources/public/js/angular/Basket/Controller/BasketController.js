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
                    PanierService.addPanier(data[product],1);
                }
            });

            $scope.delCommand = function(produit) {
                var id = $scope.basket.indexOf(produit);
                $scope.basket.splice(id,1);
            };
        }]);