<?php

namespace AppBundle\Manager;

use AppBundle\Form\CardType;
use AppBundle\Form\Model\Card;
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

    public function addToBasket(Card $cards){
        if (!$this->session->has('cart')) {
            $this->session->set('cart', []);
        }
        $cart = $this->session->get('cart');
        foreach($cards->getProducts() as $card){
                $cardItems = [
                    'product' => $card->getProducts(),
                    'quantity' => $card->getQuantity(),
                ];
            array_push($cart , $cardItems);
            $this->session->set('cart',$cart);
        }
    }
    

}