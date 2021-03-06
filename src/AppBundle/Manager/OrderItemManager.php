<?php

namespace AppBundle\Manager;

use AppBundle\Entity\OrderItem;
use Doctrine\ORM\EntityManagerInterface;

class OrderItemManager
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



    public function save(OrderItem $order_item){
        if(null === $order_item->getId())
            $this->entityManager->persist($order_item);

        $this->entityManager->flush();
    }

}