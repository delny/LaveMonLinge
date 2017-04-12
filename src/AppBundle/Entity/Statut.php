<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Statut
 *
 * @ORM\Table(name="statut")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StatutRepository")
 */
class Statut
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
     * @ORM\Column(name="label", type="string", length=255)
     */
    private $label;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dataUpdate", type="datetime")
     */
    private $dateUpdate;

    /**
     * @var OrderLaundry $orderLaundry
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\OrderLaundry")
     */
    private $orderLaundry;

    /**
     * @var OrderItem $orderItem
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\OrderItem")
     */
    private $orderItem;

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
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * @return \DateTime
     */
    public function getDateUpdate()
    {
        return $this->dateUpdate;
    }

    /**
     * @param \DateTime $dateUpdate
     */
    public function setDateUpdate($dateUpdate)
    {
        $this->dateUpdate = $dateUpdate;
    }

    /**
     * @return OrderLaundry
     */
    public function getOrderLaundry()
    {
        return $this->orderLaundry;
    }

    /**
     * @param OrderLaundry $orderLaundry
     */
    public function setOrderLaundry($orderLaundry)
    {
        $this->orderLaundry = $orderLaundry;
    }

    /**
     * @return OrderItem
     */
    public function getOrderItem()
    {
        return $this->orderItem;
    }

    /**
     * @param OrderItem $orderItem
     */
    public function setOrderItem($orderItem)
    {
        $this->orderItem = $orderItem;
    }



}

