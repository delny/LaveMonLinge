<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @var int
     *
     * @ORM\Column(name="priceIfMultiple", type="integer")
     *
     * )
     */

    private $priceIfMultiple;

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
     * @var string
     * @ORM\Column(name="img", type="string",length=255)
     */
    private $img;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->typeClothing = new \Doctrine\Common\Collections\ArrayCollection();
        $this->orderItems = new \Doctrine\Common\Collections\ArrayCollection();
    }


    public function __toString()
    {
        return $this->getName();
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
     * @return int
     */
    public function getPriceIfMultiple()
    {
        return $this->priceIfMultiple;
    }

    /**
     * @param int $priceIfMultiple
     */
    public function setPriceIfMultiple($priceIfMultiple)
    {
        $this->priceIfMultiple = $priceIfMultiple;
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
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * @param string $img
     * @return Product
     */
    public function setImg($img)
    {
        $this->img = $img;
        return $this;
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

    /**
     * Gestion  ajout image
     */
    const SERVER_PATH_TO_IMAGE_FOLDER = 'bundles/app/img/productImg';

    private $file;

    /**
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    }

    /**
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Manages the copying of the file to the relevant place on the server
     */
    public function upload()
    {
        // the file property can be empty if the field is not required
        if (null === $this->getFile()) {
            return;
        }

        // we use the original file name here but you should
        // sanitize it at least to avoid any security issues

        // move takes the target directory and target filename as params

        $this->getFile()->move(
            self::SERVER_PATH_TO_IMAGE_FOLDER,
            $this->getFile()->getClientOriginalName()
        );



        // set the path property to the filename where you've saved the file
        //$this->filename = $this->getFile()->getClientOriginalName();
        $this->img = $this->getFile()->getClientOriginalName();
        //$this->setType();

        // clean up the file property as you won't need it anymore
        $this->setFile(null);
    }

    /**
     * Lifecycle callback to upload the file to the server
     */
    public function lifecycleFileUpload()
    {
        $this->upload();
    }
}
