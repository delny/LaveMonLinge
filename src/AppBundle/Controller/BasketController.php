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
        $session = $this->container->get('session');
        if($session->has('cart')){
            $cart = $session->get('cart');
        }

        $items = $this->getManager("app.order_item_manager")->findArray(array_keys($cart->getProducts()));

        return $this->render(':panier:panier.html.twig', ['items' => $items,'cart' => $cart]);
    }

    private function getManager($manager){
        return $this->get($manager);
    }
}
