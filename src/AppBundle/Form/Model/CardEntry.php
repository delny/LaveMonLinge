<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 14/04/2017
 * Time: 12:54
 */

namespace AppBundle\Form\Model;


class CardEntry
{
    private $quantity;

    private $product;

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     * @return CardEntry
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param mixed $product
     * @return CardEntry
     */
    public function setProduct($product)
    {
        $this->product = $product;
        return $this;
    }

}