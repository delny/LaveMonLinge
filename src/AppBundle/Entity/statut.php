<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * statut
 *
 * @ORM\Table(name="statut")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\statutRepository")
 */
class statut
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
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateChangement", type="datetime")
     */
    private $dateChangement;

    /**
     * @var orderlaundry $commande
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\orderlaundry")
     */
    private $commande;

    /**
     * @var orderItem $orderitem
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\orderItem")
     */
    private $orderitem;


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
     * Set libelle
     *
     * @param string $libelle
     *
     * @return statut
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set dateChangement
     *
     * @param \DateTime $dateChangement
     *
     * @return statut
     */
    public function setDateChangement($dateChangement)
    {
        $this->dateChangement = $dateChangement;

        return $this;
    }

    /**
     * Get dateChangement
     *
     * @return \DateTime
     */
    public function getDateChangement()
    {
        return $this->dateChangement;
    }
}

