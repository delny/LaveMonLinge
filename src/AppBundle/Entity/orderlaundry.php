<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * orderlaundry
 *
 * @ORM\Table(name="orderlaundry")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\orderlaundryRepository")
 */
class orderlaundry
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
     * @ORM\Column(name="datecollecte", type="datetime")
     */
    private $datecollecte;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datelivraison", type="datetime")
     */
    private $datelivraison;

    /**
     * @var string
     *
     * @ORM\Column(name="statut", type="string", length=255)
     */
    private $statut;

    /**
     * @var int
     *
     * @ORM\Column(name="nombreSacs", type="integer")
     */
    private $nombreSacs;

    /**
     * @var int
     *
     * @ORM\Column(name="prixLivraison", type="integer")
     */
    private $prixLivraison;

    /**
     * @var int
     *
     * @ORM\Column(name="Total", type="integer")
     */
    private $total;

    /**
     * @var orderItem $orderitems
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\orderItem")
     */
    private $orderitems;

    /**
     * @var user $user
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\user")
     */
    private $user;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set datecollecte
     *
     * @param \DateTime $datecollecte
     *
     * @return orderlaundry
     */
    public function setDatecollecte($datecollecte)
    {
        $this->datecollecte = $datecollecte;

        return $this;
    }

    /**
     * Get datecollecte
     *
     * @return \DateTime
     */
    public function getDatecollecte()
    {
        return $this->datecollecte;
    }

    /**
     * Set datelivraison
     *
     * @param \DateTime $datelivraison
     *
     * @return orderlaundry
     */
    public function setDatelivraison($datelivraison)
    {
        $this->datelivraison = $datelivraison;

        return $this;
    }

    /**
     * Get datelivraison
     *
     * @return \DateTime
     */
    public function getDatelivraison()
    {
        return $this->datelivraison;
    }

    /**
     * Set statut
     *
     * @param string $statut
     *
     * @return orderlaundry
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
     * Set nombreSacs
     *
     * @param integer $nombreSacs
     *
     * @return orderlaundry
     */
    public function setNombreSacs($nombreSacs)
    {
        $this->nombreSacs = $nombreSacs;

        return $this;
    }

    /**
     * Get nombreSacs
     *
     * @return int
     */
    public function getNombreSacs()
    {
        return $this->nombreSacs;
    }

    /**
     * Set prixLivraison
     *
     * @param integer $prixLivraison
     *
     * @return orderlaundry
     */
    public function setPrixLivraison($prixLivraison)
    {
        $this->prixLivraison = $prixLivraison;

        return $this;
    }

    /**
     * Get prixLivraison
     *
     * @return int
     */
    public function getPrixLivraison()
    {
        return $this->prixLivraison;
    }

    /**
     * Set total
     *
     * @param integer $total
     *
     * @return orderlaundry
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return int
     */
    public function getTotal()
    {
        return $this->total;
    }
}

