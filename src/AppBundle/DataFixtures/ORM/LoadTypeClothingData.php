<?php
namespace AppBundle\DataFixtures\ORM;
use AppBundle\Entity\TypeClothing;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;

class LoadTypeClothingData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $datas = [

            [
                'label'=>'Chemise',
                'prix'=>5,

            ],


            [
                'label'=>'Pantalon',
                'prix'=>6,


            ],

            [
                'label'=>'Jupe',
                'prix'=>12,


            ],
        ];
        foreach ($datas as $i => $data) {
            $typeclothing = new TypeClothing();
            $typeclothing->setLabel($data['label']);
            $typeclothing->setPrice($data['prix']);


            $manager->persist($typeclothing);
            $this->addReference('-'.$i, $typeclothing);
        }
        $manager->flush();
    }
    public function getOrder()
    {
        return 3;
    }
}

