<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 13/04/2017
 * Time: 10:56
 */

namespace AppBundle\Form\Model;
use Symfony\Component\Validator\Constraints as Assert;


class Card
{

    /**
     * @var array
     */
    private $products;

    public function __construct()
    {
        $this->products = [
            new CardEntry()
        ];
    }

    /**
     * @return array
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param array $products
     * @return Card
     */
    public function setProducts($products)
    {
        $this->products = $products;
        return $this;
    }




}