<?php

namespace AppBundle\Manager;

use AppBundle\Entity\ProductType;
use Doctrine\ORM\EntityManagerInterface;

class ProductTypeManager
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getListTypeProduct()
    {
        return $this->entityManager->getRepository(ProductType::class)->getListTypeProduct();
    }
}