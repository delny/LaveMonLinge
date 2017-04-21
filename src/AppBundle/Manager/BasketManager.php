<?php

namespace AppBundle\Manager;

use AppBundle\Form\Model\Card;
use AppBundle\Form\Model\DateChoice;
use Symfony\Component\HttpFoundation\Session\Session;


class BasketManager
{
    private $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }


    public function addToBasket(Card $cards){
       $this->session->set('basket',$cards);
    }

    public function getBasket(){
        if($this->session->has('basket')){
            $basket = $this->session->get('basket');
            return $basket;
        }
    }


}