<?php

namespace AppBundle\Controller;

use AppBundle\Entity\OrderItem;
use AppBundle\Form\BasketType;
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

        $form = $request->request->all();
        $session = $this->get('session');
        $idOrderLaundry = ($session->get('idOrderLaundry')) ? $session->get('idOrderLaundry') : FALSE;
        dump($idOrderLaundry);

        if (!empty($form) AND $idOrderLaundry)
        {
            //recup de orderlaundry
            $orderLaundry = $this->getOrderManager()->getOrderLaundryById($idOrderLaundry);

            //parcours du panier
            $products = $basket->getProducts();

            $i=0;
            $tab = [];
            foreach ($products as $product)
            {
                $item = $product->getProduct();
                $quantity = $form[$i];
                $i++;

                $orderItem = new OrderItem();
                $orderItem->setProduct($item);
                $orderItem->setQte($quantity);
                $orderItem->setStatut('En attente');
                $orderItem->setOrderLaundry($orderLaundry);
                array_push($tab,$orderItem);
            }
            dump($tab);
            exit();
        }

        return $this->render(':panier:panier.html.twig', [
            'basket' => $basket,
        ]);
    }


    private function getManager($manager){
        return $this->get($manager);
    }

    private function getOrderManager()
    {
        return $this->get('app.order_manager');
    }
}
