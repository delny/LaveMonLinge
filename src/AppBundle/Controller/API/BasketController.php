<?php
// src/AppBundle/Controller/API/BasketController

namespace AppBundle\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class BasketController extends FOSRestController
{
    /**
     * @FOSRest\Get("/api/getbasket")
     * @FOSRest\View()
     */
    public function getBasketAction (Request $request)
    {
        $basket = $this->getBasketManager()->getBasket();
        if(!$basket)
        {
            // si le panier n'existe pas encore, on return un tableau vide
            return new JsonResponse();
        }

        $products = $this->getBasketManager()->getBasket()->getProducts();

        //dump($products);
        //exit();

        $formatted = [];

        foreach ($products as $product)
        {
            $option = ($product->getOptionLaundry()) ? $product->getOptionLaundry()->getLabel() : null;
            $optionPrice = ($product->getOptionLaundry()) ? $product->getOptionLaundry()->getPrice() : null;
            $quantite = ($product->getQuantity()) ? $product->getQuantity()->getPrice() : 1;

            $formatted[] = [
                'id' => $product->getProduct()->getId(),
                'name' => $product->getProduct()->getName(),
                'price' => $product->getProduct()->getPrice(),
                'quantite' => $quantite,
                'option' => $option,
                'optionPrice' => $optionPrice
            ];
        }

        //dump($formatted);
        //exit();

        return new JsonResponse($formatted);

    }

    private function getBasketManager()
    {
        return $this->get('app.basket_manager');
    }
}