'use strict';

angular
    .module('BasketApp')
    .provider('PanierService', function () {
        var MyBig = 1000;
        return {
            setBig : function (limit) {
                MyBig = limit;
            },
            $get : function (TVAService,$http) {
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
                        prixMultiple: product.priceMultiple,
                        quantite:product.quantite,
                        option: product.option,
                        optionPrice: product.optionPrice
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
                        return previous = previous + ligne.quantite*ligne.prix + ligne.optionPrice;
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
                        if (ligne.prixMultiple) {
                            return previous = previous + ligne.prix + (ligne.quantite-1)*ligne.prixMultiple + ligne.optionPrice;
                        } else {
                            return previous = previous + ligne.quantite*ligne.prix + ligne.optionPrice;
                        }
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
    });