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

    private $products;

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
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param mixed $products
     * @return CardEntry
     */
    public function setProducts($products)
    {
        $this->products = $products;
        return $this;
    }
}