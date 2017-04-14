<?php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\ProductType;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;

class LoadProductTypeData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $datas = [

            [
                'name' =>'pressing',
                'compute_price_by_weight'=> 0,
            ],
            [
                'name' =>'laverie',
                'compute_price_by_weight'=> 1,
            ],
        ];

        foreach ($datas as $i => $data) {
            $productType = new ProductType();
            $productType->setName($data['name']);
            $productType->setComputePriceByWeight($data['compute_price_by_weight']);
            $manager->persist($productType);
            $this->addReference('productType-'.$i, $productType);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 5;
    }
}

