<?php
namespace AppBundle\DataFixtures\ORM;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use AppBundle\Entity\User;
class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $datas = [

            [
                'email' =>'test@gmail.com',
                'password'=> hash('sha512','test'),
            ],


            [
                'email' =>'test2@gmail.com',
                'password'=> hash('sha512','test2'),
            ],
        ];
        foreach ($datas as $i => $data) {
            $user = new User();
            $user->setEmail($data['email']);
            $user->setPassword($data['password']);


            $manager->persist($user);
            $this->addReference('user-'.$i, $user);
        }
        $manager->flush();
    }
    public function getOrder()
    {
        return 1;
    }
}

