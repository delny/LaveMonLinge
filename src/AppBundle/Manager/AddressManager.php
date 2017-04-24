<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Address;
use Doctrine\ORM\EntityManagerInterface;

class AddressManager
{
    private $manager;

    /**
     * AddressManager constructor.
     * @param EntityManagerInterface $manager
     */
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @return Address
     */
    public function create()
    {
        return new Address();
    }

    public function save(Address $address)
    {
        if ($address->getId() === null)
        {
            $this->manager->persist($address);
        }
        $this->manager->flush();
    }

    public function getAddressByUserAndType($id,$type){
        $address = $this->manager->getRepository(Address::class)->getAddressByUserAndType($id,$type);

        return $address;

    }
}