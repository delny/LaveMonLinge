<?php

namespace AppBundle\Controller;

use AppBundle\Entity\OrderItem;
use AppBundle\Form\LaundryType;
use AppBundle\Form\Model\Laundry;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LaundryController extends Controller
{
    /**
     * @Route("/laundry", name="app_laundry_list")
     */
    public function listAction(Request $request)
    {
        // recupere liste produits
        $bag = $this->getManager('app.product_manager')->getBag();

        $form = $this->createForm(LaundryType::class, $this->getManager("app.laundry_manager")->create());
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // recuperer id produit et qte
            //jappelle mon service session pour enregistrer dans la session la qte et lid produit
            $this->getManager('app.cart_manager')->addToCart(4, $form->getData());
            // creation order_item
            $order_item = $this->getManager('app.order_item_manager')->create();
            $order_item->setQte($form->getData()->getQte());
            $order_item->setStatut('encours');

            // envoie objet order_item a sauvegarder

            $this->getManager('app.order_item_manager')->save($order_item);


            // redirection
            return $this->redirectToRoute('app_showCart');
        }
        return $this->render(':lavage:list.html.twig', ["form" => $form->createView(), 'bag' => $bag]);
    }



    private function getManager($manager){
        return $this->get($manager);
    }
}
