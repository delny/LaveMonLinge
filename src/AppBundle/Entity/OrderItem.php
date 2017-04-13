<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OrderItem
 *
 * @ORM\Table(name="order_item")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OrderItemRepository")
 */
class OrderItem
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="statut", type="string", length=255)
     */
    private $statut;


    /**
     * @var integer
     *
     * @ORM\Column(name="qte", type="integer", length=10)
     */
    private $qte;



    /**
     * @var OptionLaundry $options
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\OptionLaundry")
     */
    private $options;

    /**
     * @var product $product
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Product",
     *  inversedBy="orderItems"
     * )
     */
    private $product;

    /**
     * @var Orderlaundry $orderLaundry
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\OrderLaundry",
     *     inversedBy="orderItems")
     */
    private $orderLaundry;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * @param string $statut
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;
    }

    /**
     * @return OptionLaundry
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param OptionLaundry $options
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }

    /**
     * @return product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param product $product
     */
    public function setProduct($product)
    {
        $this->product = $product;
    }

    /**
     * @return Orderlaundry
     */
    public function getOrderLaundry()
    {
        return $this->orderLaundry;
    }

    /**
     * @param Orderlaundry $orderLaundry
     */
    public function setOrderLaundry($orderLaundry)
    {
        $this->orderLaundry = $orderLaundry;
    }

    /**
     * @return mixed
     */
    public function getQte()
    {
        return $this->qte;
    }

    /**
     * @param mixed $qte
     */
    public function setQte($qte)
    {
        $this->qte = $qte;
    }




}

