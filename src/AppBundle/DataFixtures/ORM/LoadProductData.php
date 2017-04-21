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
                'priceIfMultiple'=>0,
                'type_id' => $this->getReference('productType-0'),
                'img' => 'chemise.jpg',
            ],
            [
                'name' =>'veste',
                'price'=> 20,
                'priceIfMultiple'=>0,
                'type_id' => $this->getReference('productType-0'),
                'img' => 'chemise.jpg',
            ],
            [
                'name' =>'sac',
                'price'=> 15,
                'priceIfMultiple'=>10,
                'type_id' => $this->getReference('productType-1'),
                'img' => 'chemise.jpg',
            ],
        ];

        foreach ($datas as $i => $data) {
            $product = new Product();
            $product->setName($data['name']);
            $product->setPrice($data['price']);
            $product->setPriceIfMultiple($data['priceIfMultiple']);
            $product->setType($data['type_id']);
            $product->setImg($data['img']);
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

