<?php
namespace AppBundle\DataFixtures\ORM;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use AppBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface,ContainerAwareInterface
{
    private $container;

    /**
     * @param ContainerInterface|null $container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $encoder = $this->container->get('security.password_encoder');
        $datas = [

            [
                'email' =>'test@gmail.com',
                'password'=> 'test',
            ],


            [
                'email' =>'test2@gmail.com',
                'password'=> 'test2',
            ],
            [
                'email' =>'toto@free.com',
                'password'=> 'toto',
            ],
            [
                'email' =>'admin@gmail.com',
                'password'=> 'admin',
            ],

        ];
        foreach ($datas as $i => $data) {
            $user = new User();
            $user->setEmail($data['email']);

            $encoded = $encoder->encodePassword($user, $data['password']);
            $user->setPassword($encoded);

            if($i==3) {
                $user->setRoles(array('ROLE_ADMIN'));
            }

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

