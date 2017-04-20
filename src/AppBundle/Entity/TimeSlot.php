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
     * @ORM\Column(name="slot", type="string", length=255)
     */
    private $slot;

    /**
     * @var bool
     *
     * @ORM\Column(name="isAvailable", type="boolean")
     */
    private $isAvailable;

    /**
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\OrderLaundry",
     *  mappedBy="timeSlotCollect, timeSlotDelivery"
     * )
     */
    private $orderLaundry;



    /**
     * Constructor
     */
    public function __construct()
    {
        $this->orderLaundry = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set slot
     *
     * @param string $slot
     *
     * @return Timeslot
     */
    public function setSlot($slot)
    {
        $this->slot = $slot;

        return $this;
    }

    /**
     * Get slot
     *
     * @return string
     */
    public function getSlot()
    {
        return $this->slot;
    }

    /**
     * Set isAvailable
     *
     * @param boolean $isAvailable
     *
     * @return Timeslot
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
     * Add orderLaundry
     *
     * @param \AppBundle\Entity\OrderLaundry $orderLaundry
     *
     * @return Timeslot
     */
    public function addOrderLaundry(\AppBundle\Entity\OrderLaundry $orderLaundry)
    {
        $this->orderLaundry[] = $orderLaundry;

        return $this;
    }

    /**
     * Remove orderLaundry
     *
     * @param \AppBundle\Entity\OrderLaundry $orderLaundry
     */
    public function removeOrderLaundry(\AppBundle\Entity\OrderLaundry $orderLaundry)
    {
        $this->orderLaundry->removeElement($orderLaundry);
    }

    /**
     * Get orderLaundry
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOrderLaundry()
    {
        return $this->orderLaundry;
    }
}
