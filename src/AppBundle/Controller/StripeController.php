<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 20/04/2017
 * Time: 11:38
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class StripeController extends Controller
{

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

    public function checkoutAction(Request $request)
    {
        \Stripe\Stripe::setApiKey("sk_test_exem4WQHP8Jjcb7LfKyMgDlJ ");

        // Get the credit card details submitted by the


        if($request->getMethod() == 'POST') {
            $email = $_POST['stripeEmail'];
            $token = $_POST['stripeToken'];
            // A changer dynamiquement
            $amount = 1000;
        }


        $user = $this->getUser();

        $id = $user->getToken();

        $stripemanager = $this->get('app.stripe_manager');

        //Nouveau client
        if ($id === NULL || empty($id)) {



            $customer = $stripemanager->createCustomer($email, $token);

            $id = $customer->id;
        }

        // Creation d'un paiement
        try {

            $stripemanager->createCharge($amount,$email,$id);

            $user->setToken($id);
            $this->get('app.user_manager')->save($user);

            $this->addFlash("success", "Paiement accepté  !");
            return $this->redirectToRoute("app_payment");
        } catch (\Stripe\Error\Card $e) {

            $this->addFlash("error", "Paiement refusé .");
            return $this->redirectToRoute("app_payment");
        }
    }

    private function getManager($manager){
        return $this->get($manager);
    }
}