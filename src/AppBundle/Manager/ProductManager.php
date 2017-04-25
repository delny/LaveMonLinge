<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;


class ProductManager
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


    public function getBag(){
        $bag = $this->entityManager->getRepository(Product::class)->findAll();
        return $bag;
    }

    public function getAllProducts()
    {
        $this->entityManager->getRepository(Product::class)->findAll();
    }
}