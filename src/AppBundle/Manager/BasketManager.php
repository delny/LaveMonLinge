<?php

namespace AppBundle\Manager;

use AppBundle\Form\Model\Card;
use Symfony\Component\HttpFoundation\Session\Session;


class BasketManager
{
    private $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }


    public function addToBasket(Card $cards){
       $this->session->set('cart',$cards);
    }
    

}