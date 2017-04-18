<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class BasketController extends Controller
{

    /**
     * @Route("/basket", name="app_showBasket")
     */
    public function showBasketAction(){
        $basket = $this->getManager('app.basket_manager')->getBasket()->getProducts();
        return $this->render(':panier:panier.html.twig', ['basket' => $basket]);
    }

    private function getManager($manager){
        return $this->get($manager);
    }
}
