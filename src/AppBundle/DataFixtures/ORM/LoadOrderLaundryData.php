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
                'datecollecte' => \DateTime::createFromFormat('Y-m-d H:i:s', '2017-04-12 16:00:00'),
                'datelivraison' => \DateTime::createFromFormat('Y-m-d H:i:s', '2017-04-15 16:00:00'),
                'statut'=>'Expédié',
                'prixLivraison'=>9,
                'total'=>48,
                'user'=>$this->getReference('user-0'),
            ],


            [
                'datecollecte' => \DateTime::createFromFormat('Y-m-d H:i:s', '2017-04-15 16:00:00'),
                'datelivraison' => \DateTime::createFromFormat('Y-m-d H:i:s', '2017-04-18 16:00:00'),
                'statut'=>'Expédié',
                'prixLivraison'=>9,
                'total'=>19,
                'user'=>$this->getReference('user-1'),
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

