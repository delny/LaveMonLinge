<?php

namespace AppBundle\Manager;

use AppBundle\Entity\OrderItem;
use AppBundle\Form\Model\Laundry;
use Doctrine\ORM\EntityManagerInterface;

class SessionManager
{
    private $session;

    public function __construct(Session $session)
    {

    }


    public function addToSession()
    {
        $session = $this->container->get('session');
        if (!$session->has('cart')) {
            $session->set('cart',[]);
        }
        $cart = $session->get('cart');
        $session->set('cart',$cart);
    }
}