<?php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Product;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;

class LoadProductData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $datas = [

            [
                'name' =>'chemise',
                'price'=> 10,
                'type_id' => $this->getReference('productType-0'),
            ],
            [
                'name' =>'veste',
                'price'=> 20,
                'type_id' => $this->getReference('productType-0'),
            ],
            [
                'name' =>'sac',
                'price'=> 15,
                'type_id' => $this->getReference('productType-1'),
            ],
        ];

        foreach ($datas as $i => $data) {
            $product = new Product();
            $product->setName($data['name']);
            $product->setPrice($data['price']);
            $product->setType($data['type_id']);
            $manager->persist($product);
            $this->addReference('product-'.$i, $product);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 6;
    }
}

