<?php

namespace AppBundle\Manager;

use AppBundle\Entity\OrderItem;
use AppBundle\Entity\OrderLaundry;
use AppBundle\Entity\Product;
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

    public function saveOrderLaundry(OrderLaundry $orderLaundry)
    {
        if ($orderLaundry->getId() === null)
        {
            $this->manager->persist($orderLaundry);
        }
        else
        {
            $this->manager->merge($orderLaundry);
        }
        $this->manager->flush();
    }


    public function saveOrderItem(OrderItem $orderItem)
    {
        if ($orderItem->getId() === null)
        {
            $this->manager->persist($orderItem);
        }
        $this->manager->flush();
    }

    public function getOrderLaundryById($id)
    {
        return $this->manager->getRepository(OrderLaundry::class)->find($id);
    }

    public function getOrderItemByBarcode($barcode)
    {
        return $this->manager->getRepository(OrderItem::class)->getOrderItemByBarcode($barcode);
    }
}