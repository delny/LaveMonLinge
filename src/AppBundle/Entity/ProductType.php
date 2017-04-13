<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductType
 *
 * @ORM\Table(name="product_type")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductTypeRepository")
 */
class ProductType
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
     *
     * @ORM\Column(name="compute_price_by_weight", type="boolean")
     */
    private $computePriceByWeight;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Product",
     *     mappedBy="type")
     */
    private $products;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return ProductType
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
     * Set computePriceByWeight
     *
     * @param boolean $computePriceByWeight
     *
     * @return ProductType
     */
    public function setComputePriceByWeight($computePriceByWeight)
    {
        $this->computePriceByWeight = $computePriceByWeight;

        return $this;
    }

    /**
     * Get computePriceByWeight
     *
     * @return boolean
     */
    public function getComputePriceByWeight()
    {
        return $this->computePriceByWeight;
    }

    /**
     * Add product
     *
     * @param \AppBundle\Entity\Product $product
     *
     * @return ProductType
     */
    public function addProduct(\AppBundle\Entity\Product $product)
    {
        $this->products[] = $product;

        return $this;
    }

    /**
     * Remove product
     *
     * @param \AppBundle\Entity\Product $product
     */
    public function removeProduct(\AppBundle\Entity\Product $product)
    {
        $this->products->removeElement($product);
    }

    /**
     * Get products
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProducts()
    {
        return $this->products;
    }
}
