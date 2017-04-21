<?php


namespace AppBundle\DataFixtures\ORM;
use AppBundle\Entity\Address;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use AppBundle\Entity\OptionLaundry;


class LoadAddressData extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $datas = [
            [
                'user-id'=>$this->getReference('user-0'),
                'cp'=>'75008',
                'city'=>'Paris',
                'street'=>'Boulevard Foch',
                'type'=>'Facturation',
                'street_number'=>123



            ],

            [
                'user-id'=>$this->getReference('user-0'),
                'cp'=>'75008',
                'city'=>'Paris',
                'street'=>'Boulevard Foch',
                'type'=>'Livraison',
                'street_number'=>123


            ],

            [
                'user-id'=>$this->getReference('user-0'),
                'cp'=>'75008',
                'city'=>'Paris',
                'street'=>'Boulevard Foch',
                'type'=>'Collecte',
                'street_number'=>123

            ],

            [
                'user-id'=>$this->getReference('user-1'),
                'cp'=>'75008',
                'city'=>'Paris',
                'street'=>'Testa',
                'type'=>'Livraison',
                'street_number'=>123
            ]


        ];
        foreach ($datas as $i => $data) {
            $address = new Address();
            $address->setUser($data['user-id']);
            $address->setCp($data['cp']);
            $address->setCity($data['city']);
            $address->setStreet($data['street']);
            $address->setType($data['type']);
            $address->setStreetNumber($data['street_number']);

            $manager->persist($address);
            $this->addReference('address-'.$i, $address);
        }
        $manager->flush();
    }
    public function getOrder()
    {
        return 4;
    }

}