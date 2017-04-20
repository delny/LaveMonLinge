<?php

namespace AppBundle\Manager;

use AppBundle\Entity\User;
use AppBundle\Form\Model\UserPasswordChange;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Encoder\EncoderAwareInterface;
use AppBundle\Form\Model\UserPasswordReset;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;

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

    public function changePassword(User $user, UserPasswordChange $userPasswordChange, UserPasswordEncoder $encoder)
    {
        $newPassword = $userPasswordChange->getNewPassword();
        $newPasswordEncoded = $encoder->encodePassword($user,$newPassword);
        $user->setPassword($newPasswordEncoded);
        $this->save($user);
    }

    /**
     * @param User $user
     * @return string
     */
    public function CreateTokenToResetPassword(User $user)
    {
        return sha1('L2rM$'.$user->getId().'%u*5e4g7e');
    }

    public function verifyTokenToResetPassword(User $user,$token)
    {
        $tokenIwant = $this->CreateTokenToResetPassword($user);
        if ($token == $tokenIwant)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function resetPassword(User $user, UserPasswordReset $userPasswordReset, UserPasswordEncoder $encoder)
    {
        $newPassword = $userPasswordReset->getNewPassword();
        $newPasswordEncoded = $encoder->encodePassword($user,$newPassword);
        $user->setPassword($newPasswordEncoded);
        $this->save($user);
     }
}