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
        $products = $this->getBasketManager()->getBasket()->getProducts();

        $formatted = [];

        foreach ($products as $product)
        {
            $formatted[] = [
                'id' => $product->getProduct()->getId(),
                'name' => $product->getProduct()->getName(),
                'price' => $product->getProduct()->getPrice(),
                'quantite' => $product->getQuantity(),
            ];
        }

        return new JsonResponse($formatted);

    }

    private function getBasketManager()
    {
        return $this->get('app.basket_manager');
    }
}