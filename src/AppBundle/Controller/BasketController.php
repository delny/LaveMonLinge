<?php

namespace AppBundle\Controller;

use AppBundle\Manager\BasketManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BasketController extends Controller
{

    /**
     * @Route("/basket", name="app_showBasket")
     */
    public function showBasketAction(Request $request){
        $basket = $this->getManager('app.basket_manager')->getBasket();

        //appel manager


        //instance

        //creation formulaire



        return $this->render(':panier:panier.html.twig', ['basket' => $basket]);
    }


    private function getManager($manager){
        return $this->get($manager);
    }
}
