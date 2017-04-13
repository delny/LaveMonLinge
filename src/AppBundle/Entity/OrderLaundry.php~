<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OrderLaundry
 *
 * @ORM\Table(name="orderlaundry")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OrderLaundryRepository")
 */
class OrderLaundry
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
     * @var \DateTime
     *
     * @ORM\Column(name="dataCollect", type="datetime")
     */
    private $dataCollect;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dataDelivery", type="datetime")
     */
    private $dataDelivery;

    /**
     * @var string
     *
     * @ORM\Column(name="statut", type="string", length=255)
     */
    private $statut;

    /**
     * @var int
     *
     * @ORM\Column(name="nbBags", type="integer")
     */
    private $nbBags;

    /**
     * @var int
     *
     * @ORM\Column(name="priceDelivery", type="integer")
     */
    private $priceDelivery;

    /**
     * @var int
     *
     * @ORM\Column(name="Total", type="integer")
     */
    private $total;

    /**
     * @var OrderItem $orderItems
     * @ORM\OneToMany(
     *     targetEntity="AppBundle\Entity\orderItem",
     *     mappedBy="orderLaundry"
     * )
     */
    private $orderItems;

    /**
     * @var user $user
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     */
    private $user;

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
     * @return \DateTime
     */
    public function getDataCollect()
    {
        return $this->dataCollect;
    }

    /**
     * @param \DateTime $dataCollect
     */
    public function setDataCollect($dataCollect)
    {
        $this->dataCollect = $dataCollect;
    }

    /**
     * @return \DateTime
     */
    public function getDataDelivery()
    {
        return $this->dataDelivery;
    }

    /**
     * @param \DateTime $dataDelivery
     */
    public function setDataDelivery($dataDelivery)
    {
        $this->dataDelivery = $dataDelivery;
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
     * @return int
     */
    public function getNbBags()
    {
        return $this->nbBags;
    }

    /**
     * @param int $nbBags
     */
    public function setNbBags($nbBags)
    {
        $this->nbBags = $nbBags;
    }

    /**
     * @return int
     */
    public function getPriceDelivery()
    {
        return $this->priceDelivery;
    }

    /**
     * @param int $priceDelivery
     */
    public function setPriceDelivery($priceDelivery)
    {
        $this->priceDelivery = $priceDelivery;
    }

    /**
     * @return int
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param int $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }

    /**
     * @return OrderItem
     */
    public function getOrderItems()
    {
        return $this->orderItems;
    }

    /**
     * @param OrderItem $orderItems
     */
    public function setOrderItems($orderItems)
    {
        $this->orderItems = $orderItems;
    }

    /**
     * @return user
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param user $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }


}

