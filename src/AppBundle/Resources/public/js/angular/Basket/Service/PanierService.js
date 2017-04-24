'use strict';

angular
    .module('BasketApp')
    .provider('PanierService', [
        '$http',
        function ($http) {
        var MyBig = 1000;
        return {
            setBig : function (limit) {
                MyBig = limit;
            },
            $get : function (TVAService) {
                var Service = {};
                var Data = [];
                var url = 'http://localhost:8000/api/getbasket';
                var appel = $http.get(url);

                Service.getPanier = function () {
                    return Data;
                };

                Service.getList = function () {
                    return appel.then(function (response){
                        return response.data;
                    },function (response){
                        console.warn('echec!',response);
                        return [];
                    });
                };



                Service.addPanier = function(product,quantite) {
                    for(var index in Data){
                        if(Data[index].reference===product['ISBN-13']){
                            Data[index].quantite += quantite;
                            return;
                        }
                    }
                    Data.push({
                        reference: product.id,
                        nom: product.name,
                        prix: product.price,
                        quantite:quantite
                    });
                };

                Service.removePanier = function (article) {
                    var id = Data.indexOf(article);
                    Data.splice(id,1);
                };

                Service.getPriceHT = function (ref) {
                    return Data.filter(function (ligne) {
                        return ligne.reference === ref
                    }).reduce(function (previous,ligne) {
                        return previous = previous + ligne.quantite*ligne.prix;
                    },0);
                };

                Service.getPriceTTC = function (ref) {
                    return Data.filter(function (ligne) {
                        return ligne.reference === ref
                    }).reduce(function (previous,ligne) {
                        return previous = previous + ligne.quantite*ligne.prix*TVAService;
                    },0);
                };

                Service.getTotalHT = function () {
                    return Data.reduce(function (previous,ligne) {
                        return previous = previous + ligne.quantite*ligne.prix;
                    },0);
                };

                Service.getTotalTTC = function () {
                    return Data.reduce(function (previous,ligne) {
                        return previous = previous + ligne.quantite*ligne.prix*TVAService;
                    },0);
                };

                Service.isBig = function (ref) {
                    return Service.getPriceHT(ref)>MyBig;
                };

                return Service;
            }
        }
    }]);