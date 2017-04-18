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
     * @ORM\Column(name="date_collect", type="datetime")
     */
    private $dateCollect;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_delivery", type="datetime")
     */
    private $dateDelivery;

    /**
     * @var string
     *
     * @ORM\Column(name="statut", type="string", length=255)
     */
    private $statut;


    /**
     * @var int
     *
     * @ORM\Column(name="price_delivery", type="integer")
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
     *     targetEntity="AppBundle\Entity\OrderItem",
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
     * Constructor
     */
    public function __construct()
    {
        $this->orderItems = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set dateCollect
     *
     * @param \DateTime $dateCollect
     *
     * @return OrderLaundry
     */
    public function setDateCollect($dateCollect)
    {
        $this->dateCollect = $dateCollect;

        return $this;
    }

    /**
     * Get dateCollect
     *
     * @return \DateTime
     */
    public function getDateCollect()
    {
        return $this->dateCollect;
    }

    /**
     * Set dateDelivery
     *
     * @param \DateTime $dateDelivery
     *
     * @return OrderLaundry
     */
    public function setDateDelivery($dateDelivery)
    {
        $this->dateDelivery = $dateDelivery;

        return $this;
    }

    /**
     * Get dateDelivery
     *
     * @return \DateTime
     */
    public function getDateDelivery()
    {
        return $this->dateDelivery;
    }

    /**
     * Set statut
     *
     * @param string $statut
     *
     * @return OrderLaundry
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return string
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set priceDelivery
     *
     * @param integer $priceDelivery
     *
     * @return OrderLaundry
     */
    public function setPriceDelivery($priceDelivery)
    {
        $this->priceDelivery = $priceDelivery;

        return $this;
    }

    /**
     * Get priceDelivery
     *
     * @return integer
     */
    public function getPriceDelivery()
    {
        return $this->priceDelivery;
    }

    /**
     * Set total
     *
     * @param integer $total
     *
     * @return OrderLaundry
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return integer
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Add orderItem
     *
     * @param \AppBundle\Entity\orderItem $orderItem
     *
     * @return OrderLaundry
     */
    public function addOrderItem(\AppBundle\Entity\orderItem $orderItem)
    {
        $this->orderItems[] = $orderItem;

        return $this;
    }

    /**
     * Remove orderItem
     *
     * @param \AppBundle\Entity\orderItem $orderItem
     */
    public function removeOrderItem(\AppBundle\Entity\orderItem $orderItem)
    {
        $this->orderItems->removeElement($orderItem);
    }

    /**
     * Get orderItems
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOrderItems()
    {
        return $this->orderItems;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return OrderLaundry
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
