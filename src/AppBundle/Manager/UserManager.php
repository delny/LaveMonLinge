<?php

namespace AppBundle\Manager;

use AppBundle\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class UserManager
{
    private $manager;

    /**
     * UserManager constructor.
     * @param EntityManagerInterface $manager
     */
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @return User
     */
    public function create()
    {
        return new User();
    }

    /**
     * @param User $user
     */
    public function save(User $user)
    {
        if ($user->getId() === null)
        {
            $this->manager->persist($user);
            $password = $user->getPassword();
            $user->setPassword(sha1($password));
        }
        $this->manager->flush($user);
    }
}