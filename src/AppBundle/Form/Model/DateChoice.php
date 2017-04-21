<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 13/04/2017
 * Time: 10:56
 */

namespace AppBundle\Form\Model;
use Symfony\Component\Validator\Constraints as Assert;


class DateChoice
{
    /**
     * @Assert\NotBlank()
     */
    private $dateCollect;

    /**
     * @Assert\NotBlank()
     */
    private $dateDelivery;

    /**
     * @Assert\NotBlank()
     */
    private $hourCollect;

    /**
     * @Assert\NotBlank()
     */
    private $hourDelivery;

    /**
     * @return mixed
     */
    public function getDateCollect()
    {
        return $this->dateCollect;
    }

    /**
     * @param mixed $dateCollect
     * @return DateChoice
     */
    public function setDateCollect($dateCollect)
    {
        $this->dateCollect = $dateCollect;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateDelivery()
    {
        return $this->dateDelivery;
    }

    /**
     * @param mixed $dateDelivery
     * @return DateChoice
     */
    public function setDateDelivery($dateDelivery)
    {
        $this->dateDelivery = $dateDelivery;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHourCollect()
    {
        return $this->hourCollect;
    }

    /**
     * @param mixed $hourCollect
     * @return DateChoice
     */
    public function setHourCollect($hourCollect)
    {
        $this->hourCollect = $hourCollect;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHourDelivery()
    {
        return $this->hourDelivery;
    }

    /**
     * @param mixed $hourDelivery
     * @return DateChoice
     */
    public function setHourDelivery($hourDelivery)
    {
        $this->hourDelivery = $hourDelivery;
        return $this;
    }

}