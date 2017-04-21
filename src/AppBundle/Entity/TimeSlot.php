<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Timeslot
 *
 * @ORM\Table(name="timeslot")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TimeslotRepository")
 */
class TimeSlot
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
     * @ORM\Column(name="slot_start", type="string", length=255)
     */
    private $slotStart;

    /**
     * @var string
     *
     * @ORM\Column(name="slot_end", type="string", length=255)
     */
    private $slotEnd;

    /**
     * @var bool
     *
     * @ORM\Column(name="isAvailable", type="boolean")
     */
    private $isAvailable;

    /**
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\OrderLaundry",
     *  mappedBy="timeSlotCollect"
     * )
     */
    private $orderLaundryCollect;

    /**
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\OrderLaundry",
     *  mappedBy="timeSlotDelivery"
     * )
     */
    private $orderLaundryDelivery;

    /**
     * @return string
     */
    public function getSlotStart()
    {
        return $this->slotStart;
    }

    /**
     * @param string $slotStart
     * @return TimeSlot
     */
    public function setSlotStart($slotStart)
    {
        $this->slotStart = $slotStart;
        return $this;
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->orderLaundryCollect = new \Doctrine\Common\Collections\ArrayCollection();
        $this->orderLaundryDelivery = new \Doctrine\Common\Collections\ArrayCollection();
    }


    function __toString()
    {
        return $this->getSlotStart().'-'.$this->getSlotEnd();

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
     * Set isAvailable
     *
     * @param boolean $isAvailable
     *
     * @return TimeSlot
     */
    public function setIsAvailable($isAvailable)
    {
        $this->isAvailable = $isAvailable;

        return $this;
    }

    /**
     * Get isAvailable
     *
     * @return boolean
     */
    public function getIsAvailable()
    {
        return $this->isAvailable;
    }

    /**
     * Add orderLaundryCollect
     *
     * @param \AppBundle\Entity\OrderLaundry $orderLaundryCollect
     *
     * @return TimeSlot
     */
    public function addOrderLaundryCollect(\AppBundle\Entity\OrderLaundry $orderLaundryCollect)
    {
        $this->orderLaundryCollect[] = $orderLaundryCollect;

        return $this;
    }

    /**
     * Remove orderLaundryCollect
     *
     * @param \AppBundle\Entity\OrderLaundry $orderLaundryCollect
     */
    public function removeOrderLaundryCollect(\AppBundle\Entity\OrderLaundry $orderLaundryCollect)
    {
        $this->orderLaundryCollect->removeElement($orderLaundryCollect);
    }

    /**
     * Get orderLaundryCollect
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOrderLaundryCollect()
    {
        return $this->orderLaundryCollect;
    }

    /**
     * Add orderLaundryDelivery
     *
     * @param \AppBundle\Entity\OrderLaundry $orderLaundryDelivery
     *
     * @return TimeSlot
     */
    public function addOrderLaundryDelivery(\AppBundle\Entity\OrderLaundry $orderLaundryDelivery)
    {
        $this->orderLaundryDelivery[] = $orderLaundryDelivery;

        return $this;
    }

    /**
     * Remove orderLaundryDelivery
     *
     * @param \AppBundle\Entity\OrderLaundry $orderLaundryDelivery
     */
    public function removeOrderLaundryDelivery(\AppBundle\Entity\OrderLaundry $orderLaundryDelivery)
    {
        $this->orderLaundryDelivery->removeElement($orderLaundryDelivery);
    }

    /**
     * Get orderLaundryDelivery
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOrderLaundryDelivery()
    {
        return $this->orderLaundryDelivery;
    }

    /**
     * @return string
     */
    public function getSlotEnd()
    {
        return $this->slotEnd;
    }

    /**
     * @param string $slotEnd
     * @return TimeSlot
     */
    public function setSlotEnd($slotEnd)
    {
        $this->slotEnd = $slotEnd;
        return $this;
    }

}
