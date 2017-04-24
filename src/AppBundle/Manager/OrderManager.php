<?php

namespace AppBundle\Manager;

use AppBundle\Entity\OrderItem;
use AppBundle\Entity\OrderLaundry;
use AppBundle\Entity\User;
use AppBundle\Form\Model\Card;
use Doctrine\ORM\EntityManagerInterface;


class OrderManager
{
    private $manager;

    private $priceDelivery;

    private $basketManager;

    public function __construct(EntityManagerInterface $manager, $priceDelivery, $basketManager)
    {
        $this->manager = $manager;
        $this->priceDelivery = $priceDelivery;
        $this->basketManager = $basketManager;
    }

    public function create()
    {
        return new OrderLaundry();
    }

    public function save(Card $card, User $user){

        $orderLaundry = $this->create();

        $orderLaundry->setDateCollect(new \DateTime($card->getDateCollect()));
        $orderLaundry->setDateDelivery(new \DateTime($card->getDateDelivery()));
        $orderLaundry->setStatut('en attente');
        $orderLaundry->setTimeSlotCollect($this->manager->merge($card->getHourCollect()));
        $orderLaundry->setTimeSlotDelivery($this->manager->merge($card->getHourDelivery()));
        $orderLaundry->setUser($user);
        $orderLaundry->setPriceDelivery($this->priceDelivery);
        $orderLaundry->setTotal(0);

        $this->manager->persist($orderLaundry);

        $this->manager->flush();

        return $orderLaundry->getId();

    }

    public function getOrderLaundryById($id)
    {
        return $this->manager->getRepository(OrderLaundry::class)->find($id);
    }

}