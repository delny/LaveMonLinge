<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductRepository")
 */
class Product
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ProductType",
     *     inversedBy="products")
     */
    private $type;

    /**
     * @var int
     *
     * @ORM\Column(name="price", type="integer")
     */
    private $price;

    /**
     * @var TypeClothing $typeClothing
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\TypeClothing")
     */
    private $typeClothing;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\OrderItem",
     *  mappedBy="product" )
     */
    private $orderItems;
    


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->typeClothing = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return Product
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set price
     *
     * @param integer $price
     *
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return integer
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set type
     *
     * @param \AppBundle\Entity\ProductType $type
     *
     * @return Product
     */
    public function setType(\AppBundle\Entity\ProductType $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \AppBundle\Entity\ProductType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Add typeClothing
     *
     * @param \AppBundle\Entity\TypeClothing $typeClothing
     *
     * @return Product
     */
    public function addTypeClothing(\AppBundle\Entity\TypeClothing $typeClothing)
    {
        $this->typeClothing[] = $typeClothing;

        return $this;
    }

    /**
     * Remove typeClothing
     *
     * @param \AppBundle\Entity\TypeClothing $typeClothing
     */
    public function removeTypeClothing(\AppBundle\Entity\TypeClothing $typeClothing)
    {
        $this->typeClothing->removeElement($typeClothing);
    }

    /**
     * Get typeClothing
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTypeClothing()
    {
        return $this->typeClothing;
    }

    /**
     * Add orderItem
     *
     * @param \AppBundle\Entity\OrderItem $orderItem
     *
     * @return Product
     */
    public function addOrderItem(\AppBundle\Entity\OrderItem $orderItem)
    {
        $this->orderItems[] = $orderItem;

        return $this;
    }

    /**
     * Remove orderItem
     *
     * @param \AppBundle\Entity\OrderItem $orderItem
     */
    public function removeOrderItem(\AppBundle\Entity\OrderItem $orderItem)
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
}
