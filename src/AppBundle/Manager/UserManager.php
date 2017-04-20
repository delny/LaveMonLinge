<?php

namespace AppBundle\Manager;

use AppBundle\Entity\OrderLaundry;
use AppBundle\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\Session;

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
        }
        $this->manager->flush();
    }

    public function getUserByEmail($email)
    {
        return $this->manager->getRepository(User::class)->getUserByEmail($email);
    }

    public function getUserById($id)
    {
        return $this->manager->getRepository(User::class)->getUserById($id);
    }

    /**
     * @return mixed|null
     */
    public function getUserConnected()
    {
        $session = new Session();
        $userId = $session->get('userId');
        if ($userId == null)
        {
            return null;
        }

        return $this->getUserById($userId);
    }

    /**
     * @return array
     */
    public function getAllUsers()
    {
        return $this->manager->getRepository(User::class)->getAllUsers();
    }

    /**
     * @param User $user
     */
    public function getListOrdersByUser(User $user)
    {
        return $this->manager->getRepository(OrderLaundry::class)->getListOrdersByUser($user);
    }
}