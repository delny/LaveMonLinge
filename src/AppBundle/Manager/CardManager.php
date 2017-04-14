<?php

namespace AppBundle\Manager;

use AppBundle\Form\Model\Laundry;
use Symfony\Component\HttpFoundation\Session\Session;


class CardManager
{
    private $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }


    public function addToCart($id, Laundry $laundry)
    {

        if (!$this->session->has('cart')) {
            $this->session->set('cart',[]);
        }
        $cart = $this->session->get('cart');

        $cart[$id] = $laundry->getQte();
        $this->session->set('cart',$cart);

    }

    

}