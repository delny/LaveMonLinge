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

    private $orderId;

    /**
     * @return mixed
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @param mixed $orderId
     * @return Card
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
        return $this;
    }
    /**
     * @Assert\NotBlank(groups={"chooseDate"})
     */
    private $dateCollect;

    /**
     * @Assert\NotBlank(groups={"chooseDate"})
     */
    private $dateDelivery;

    /**
     * @Assert\NotBlank(groups={"chooseDate"})
     */
    private $hourCollect;

    /**
     * @Assert\NotBlank(groups={"chooseDate"})
     */
    private $hourDelivery;

    public function __construct()
    {
        $this->products = [
            new CardEntry()
        ];
    }

    /**
     * @return mixed
     */
    public function getDateCollect()
    {
        return $this->dateCollect;
    }

    /**
     * @param mixed $dateCollect
     * @return Card
     */
    public function setDateCollect($dateCollect)
    {
        $this->dateCollect = $dateCollect;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateDelivery()
    {
        return $this->dateDelivery;
    }

    /**
     * @param mixed $dateDelivery
     * @return Card
     */
    public function setDateDelivery($dateDelivery)
    {
        $this->dateDelivery = $dateDelivery;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHourCollect()
    {
        return $this->hourCollect;
    }

    /**
     * @param mixed $hourCollect
     * @return Card
     */
    public function setHourCollect($hourCollect)
    {
        $this->hourCollect = $hourCollect;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHourDelivery()
    {
        return $this->hourDelivery;
    }

    /**
     * @param mixed $hourDelivery
     * @return Card
     */
    public function setHourDelivery($hourDelivery)
    {
        $this->hourDelivery = $hourDelivery;
        return $this;
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