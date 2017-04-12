<?php
namespace AppBundle\DataFixtures\ORM;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use AppBundle\Entity\OptionLaundry;


class LoadOptionLaundryData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $datas = [
            [
                'label'=>'Livraison',
                'price'=>9,


            ],

            [
                'label' =>'Lessive Miremachine',
                'price' =>5


            ],

            [
                'label' =>'Lessive Mr Propre',
                'price' =>7
                ,

            ],

            [
                'label'=>'Finition à la main',
                'price'=>10,
            ]


        ];
        foreach ($datas as $i => $data) {
            $option = new OptionLaundry();
            $option->setLabel($data['label']);
            $option->setPrice($data['price']);
            $manager->persist($option);
            $this->addReference('option-'.$i, $option);
        }
        $manager->flush();
    }
    public function getOrder()
    {
        return 4;
    }
}
{

}