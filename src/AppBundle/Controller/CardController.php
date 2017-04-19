<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ProductType;
use AppBundle\Form\CardType;
use AppBundle\Form\Model\Card;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CardController extends Controller
{
    /**
     * @Route("/form/{id}", name="app_form_card")
     */
    public function formAction(Request $request, ProductType $productType)
    {
        $form = $this->createForm(CardType::class, new Card(), ['productType' => $productType]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getManager('app.basket_manager')->addToBasket($form->getData());
            return $this->redirectToRoute('app_showBasket');
        }
        return $this->render(':lavage:list.html.twig', array('form' => $form->createView()));
    }


    /**
     * @Route("/payment", name="app_payment")
     */

    public function prepareAction()
    {
        //A remplacer plus tard par le total récupéré une fois la commande réalisée
        $total = 10;
        $total .= "00";
        //Pour mettre le montant exact dans Sprite qui sera en centimes

        return $this->render(':paiement:paiement.html.twig', [
            'total' => $total,
        ]);

    }

    /**
     * @Route(
     *     "/checkout",
     *     name="app_payment_send",
     *     methods="POST"
     * )
     */

    public function checkoutAction()
    {
        \Stripe\Stripe::setApiKey("sk_test_exem4WQHP8Jjcb7LfKyMgDlJ ");

        // Get the credit card details submitted by the form

        $email = $_POST['stripeEmail'];
        $token = $_POST['stripeToken'];


        $user = $this->getUser();
        //Si c'est un nouveau client
        if ($user->getToken() === NULL || empty($user->getToken())) {
            // Create a Customer:
            $customer = \Stripe\Customer::create(array(
                "email" => $email,
                "source" => $token,
            ));
            // Create a charge
            try {
                $charge = \Stripe\Charge::create(array(
                    "amount" => 1000, // Centimes
                    "currency" => "eur",
                    "description" => "Paiement de" . $email,
                    "customer" => $customer->id,


                ));
                $user->setToken($customer->id);
                $this->get('app.user_manager')->save($user);
                $this->addFlash("success", "Paiement accepté !");
                return $this->redirectToRoute("app_payment");
            } catch (\Stripe\Error\Card $e) {

                $this->addFlash("error", "Paiement refusé .");
                return $this->redirectToRoute("app_payment");
                // The card has been declined
            }
        } else {
            try {
                $charge = \Stripe\Charge::create(array(
                    "amount" => 1000,
                    "currency" => "eur",
                    "customer" => $user->getToken(),
                ));
                $this->addFlash("success", "Paiement accepté bis !");
                return $this->redirectToRoute("app_payment");
            } catch (\Stripe\Error\Card $e) {
                $this->addFlash("error", "Paiement refusé .");
                return $this->redirectToRoute("app_payment");
                // The card has been declined
            }
        }
    }




    private function getManager($manager){
        return $this->get($manager);
    }
}
