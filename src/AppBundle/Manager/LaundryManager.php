<?php

namespace AppBundle\Manager;

use AppBundle\Entity\OrderItem;
use AppBundle\Form\Model\Laundry;
use Doctrine\ORM\EntityManagerInterface;

class LaundryManager
{
    private $entityManager;

    /**
     * UserManager constructor.
     * @param EntityManagerInterface $manager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @return User
     */
    public function create()
    {
        return new Laundry();
    }

    public function findArray($cart){
        $categories = $this->entityManager->getRepository(OrderItem::class)->findArray($cart);
        return $categories;
    }
}