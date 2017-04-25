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

        if (!empty($form) AND $idOrderLaundry)
        {
            //recup de orderlaundry
            $orderLaundry = $this->getOrderManager()->getOrderLaundryById($idOrderLaundry);

            //parcours du panier
            $products = $basket->getProducts();

            $i=0;
            $total = 0;
            foreach ($products as $product)
            {
                $item = $product->getProduct();
                $optionLaundry = $product->getOptionLaundry();


                //suite chiffre aleatoire unique pour chaque sac
                do
                {
                    $barcode = mt_rand(1000000000,9999999999);
                }
                while($this->getOrderManager()->getOrderItemByBarcode($barcode));

                $quantity = $form[$i];
                $i++;

                $orderItem = new OrderItem();
                $orderItem->setProduct($this->get('doctrine')->getManager()->merge($item));
                $orderItem->setQte($quantity);
                $orderItem->setStatut('En attente');
                $orderItem->setOrderLaundry($orderLaundry);
                $orderItem->setBarcode($barcode);
                $orderItem->addOption($this->get('doctrine')->getManager()->merge($optionLaundry));


                $this->getOrderManager()->saveOrderItem($orderItem);

                //gestion prix multiple
                if ($orderItem->getProduct()->getPriceIfMultiple())
                {
                    $price = $orderItem->getProduct()->getPrice() + ($quantity-1)*$orderItem->getProduct()->getPriceIfMultiple();
                }
                else
                {
                    $price = $orderItem->getProduct()->getPrice() * $quantity;
                }

                $total += $price + $product->getOptionLaundry()->getPrice();


            }

            //mis a jour orderlaundry
            $orderLaundry->setTotal($total + $orderLaundry->getPriceDelivery());
            $orderLaundry->setIsPay(0);
            $this->getOrderManager()->saveOrderLaundry($orderLaundry);

            //redirection
             return $this->redirectToRoute('app_payment');
        }

        if($idOrderLaundry == false){
            return $this->redirectToRoute('homepage');

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
