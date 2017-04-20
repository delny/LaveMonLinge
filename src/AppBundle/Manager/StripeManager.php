<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 19/04/2017
 * Time: 15:01
 */

namespace AppBundle\Manager;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;



class StripeManager
{
    private $manager;




    /**
     * UserManager constructor.
     * @param EntityManagerInterface $manager
     */
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;

    }

    public function  createCustomer($email,$token){

        return $customer = \Stripe\Customer::create(array(
            "email" => $email,
            "source" => $token,
        ));
    }

    public function createCharge($amount,$email,$idcustom){
            $charge = \Stripe\Charge::create(array(
                "amount" => $amount,
                "currency" => "eur",
                "description" => "Paiement de" . $email,
                "customer" => $idcustom,

            ));
    }



}