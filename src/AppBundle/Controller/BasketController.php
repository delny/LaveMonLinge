<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class BasketController extends Controller
{
    /**
     * @Route("/addtocart/{id}", name="app_addToCart")
     */
    public function addToCartAction($id)
    {
        $session = $this->container->get('session');
        if (!$session->has('cart')) {
            $session->set('cart',[]);
        }
        $cart = $session->get('cart');
        $cart[$id] = 1;

        $session->set('cart',$cart);
        return $this->redirectToRoute("app_showCart");
    }
    /**
     * @Route("/cart", name="app_showCart")
     */
    public function showCardAction(){
        $session = $this->container->get('session');
        if($session->has('cart')){
            $cart = $session->get('cart');
        }

        $items = $this->getManager("app.order_item_manager")->findArray(array_keys($cart));
        //dump($items);
        //dump($items[0]->setQte($qte));
        //die();
        return $this->render(':panier:panier.html.twig', ['items' => $items,'cart' => $cart]);
    }

    private function getManager($manager){
        return $this->get($manager);
    }
}
