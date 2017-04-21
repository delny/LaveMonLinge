<?php
namespace AppBundle\DataFixtures\ORM;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use AppBundle\Entity\OrderLaundry;
class LoadOrderLaundryData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $datas = [

            [
                'datecollecte' => \DateTime::createFromFormat('Y-m-d H:i:s', '2017-04-12 14:00:00'),
                'datelivraison' => \DateTime::createFromFormat('Y-m-d H:i:s', '2017-04-15 14:00:00'),
                'timeSlotCollect' => $this->getReference('timeSlot-2'),
                'timeSlotDelivery' => $this->getReference('timeSlot-4'),
                'statut'=>'Expédié',
                'prixLivraison'=>9,
                'total'=>48,
                'user'=>$this->getReference('user-0'),
            ],


            [
                'datecollecte' => \DateTime::createFromFormat('Y-m-d H:i:s', '2017-04-15 14:00:00'),
                'datelivraison' => \DateTime::createFromFormat('Y-m-d H:i:s', '2017-04-18 14:00:00'),
                'timeSlotCollect' => $this->getReference('timeSlot-3'),
                'timeSlotDelivery' => $this->getReference('timeSlot-5'),
                'statut'=>'Expédié',
                'prixLivraison'=>9,
                'total'=>19,
                'user'=>$this->getReference('user-1'),
            ],

            [
                'datecollecte' => \DateTime::createFromFormat('Y-m-d H:i:s', '2017-01-10 14:00:00'),
                'datelivraison' => \DateTime::createFromFormat('Y-m-d H:i:s', '2017-01-13 14:00:00'),
                'timeSlotCollect' => $this->getReference('timeSlot-0'),
                'timeSlotDelivery' => $this->getReference('timeSlot-5'),
                'statut'=>'Expédié',
                'prixLivraison'=>9,
                'total'=>24,
                'user'=>$this->getReference('user-2'),
            ],

            [
                'datecollecte' => \DateTime::createFromFormat('Y-m-d H:i:s', '2017-02-16 14:00:00'),
                'datelivraison' => \DateTime::createFromFormat('Y-m-d H:i:s', '2017-02-24 14:00:00'),
                'timeSlotCollect' => $this->getReference('timeSlot-1'),
                'timeSlotDelivery' => $this->getReference('timeSlot-4'),
                'statut'=>'Expédié',
                'prixLivraison'=>9,
                'total'=>35,
                'user'=>$this->getReference('user-2'),
            ],

            [
                'datecollecte' => \DateTime::createFromFormat('Y-m-d H:i:s', '2017-03-25 14:00:00'),
                'datelivraison' => \DateTime::createFromFormat('Y-m-d H:i:s', '2017-03-28 14:00:00'),
                'timeSlotCollect' => $this->getReference('timeSlot-4'),
                'timeSlotDelivery' => $this->getReference('timeSlot-0'),
                'statut'=>'Expédié',
                'prixLivraison'=>9,
                'total'=>47,
                'user'=>$this->getReference('user-2'),
            ],

            [
                'datecollecte' => \DateTime::createFromFormat('Y-m-d H:i:s', '2017-04-01 14:00:00'),
                'datelivraison' => \DateTime::createFromFormat('Y-m-d H:i:s', '2017-04-04 14:00:00'),
                'timeSlotCollect' => $this->getReference('timeSlot-3'),
                'timeSlotDelivery' => $this->getReference('timeSlot-2'),
                'statut'=>'Expédié',
                'prixLivraison'=>9,
                'total'=>67,
                'user'=>$this->getReference('user-2'),
            ],

            [
                'datecollecte' => \DateTime::createFromFormat('Y-m-d H:i:s', '2017-05-12 14:00:00'),
                'datelivraison' => \DateTime::createFromFormat('Y-m-d H:i:s', '2017-05-15 14:00:00'),
                'timeSlotCollect' => $this->getReference('timeSlot-5'),
                'timeSlotDelivery' => $this->getReference('timeSlot-1'),
                'statut'=>'Expédié',
                'prixLivraison'=>9,
                'total'=>35,
                'user'=>$this->getReference('user-2'),
            ],

            [
                'datecollecte' => \DateTime::createFromFormat('Y-m-d H:i:s', '2017-06-12 14:00:00'),
                'datelivraison' => \DateTime::createFromFormat('Y-m-d H:i:s', '2017-06-16 14:00:00'),
                'timeSlotCollect' => $this->getReference('timeSlot-4'),
                'timeSlotDelivery' => $this->getReference('timeSlot-0'),
                'statut'=>'Expédié',
                'prixLivraison'=>9,
                'total'=>98,
                'user'=>$this->getReference('user-2'),
            ],

            [
                'datecollecte' => \DateTime::createFromFormat('Y-m-d H:i:s', '2017-07-21 14:00:00'),
                'datelivraison' => \DateTime::createFromFormat('Y-m-d H:i:s', '2017-07-24 14:00:00'),
                'timeSlotCollect' => $this->getReference('timeSlot-5'),
                'timeSlotDelivery' => $this->getReference('timeSlot-4'),
                'statut'=>'Expédié',
                'prixLivraison'=>9,
                'total'=>124,
                'user'=>$this->getReference('user-2'),
            ],

            [
                'datecollecte' => \DateTime::createFromFormat('Y-m-d H:i:s', '2017-08-02 14:00:00'),
                'datelivraison' => \DateTime::createFromFormat('Y-m-d H:i:s', '2017-08-05 14:00:00'),
                'timeSlotCollect' => $this->getReference('timeSlot-0'),
                'timeSlotDelivery' => $this->getReference('timeSlot-1'),
                'statut'=>'Expédié',
                'prixLivraison'=>9,
                'total'=>75,
                'user'=>$this->getReference('user-2'),
            ],

            [
                'datecollecte' => \DateTime::createFromFormat('Y-m-d H:i:s', '2017-09-26 14:00:00'),
                'datelivraison' => \DateTime::createFromFormat('Y-m-d H:i:s', '2017-09-29 14:00:00'),
                'timeSlotCollect' => $this->getReference('timeSlot-5'),
                'timeSlotDelivery' => $this->getReference('timeSlot-0'),
                'statut'=>'Expédié',
                'prixLivraison'=>9,
                'total'=>26,
                'user'=>$this->getReference('user-2'),
            ],
        ];
        foreach ($datas as $i => $data) {
            $order = new OrderLaundry();
            $order->setDateCollect($data['datecollecte']);
            $order->setDateDelivery($data['datelivraison']);
            $order->setStatut($data['statut']);
            $order->setPriceDelivery($data['prixLivraison']);
            $order->setTotal($data['total']);
            $order->setUser($data['user']);
            $order->setTimeSlotCollect($data['timeSlotCollect']);
            $order->setTimeSlotDelivery($data['timeSlotDelivery']);


            $manager->persist($order);
            $this->addReference('order-'.$i, $order);
        }
        $manager->flush();
    }
    public function getOrder()
    {
        return 3;
    }
}

