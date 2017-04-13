<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 13/04/2017
 * Time: 10:56
 */

namespace AppBundle\Form\Model;
use Symfony\Component\Validator\Constraints as Assert;


class Laundry
{
    /**
     * @Assert\NotBlank()
     * @Assert\NotEqualTo(value = 0)
     */
    protected $qte;

    /**
     * @return mixed
     */
    public function getQte()
    {
        return $this->qte;
    }

    /**
     * @param mixed $qte
     */
    public function setQte($qte)
    {
        $this->qte = $qte;
    }

}