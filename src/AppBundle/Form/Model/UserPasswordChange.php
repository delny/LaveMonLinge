<?php

namespace AppBundle\Form\Model;

use Symfony\Component\Security\Core\User\UserInterface;

class UserPasswordChange
{
    private $oldPassword;
    private $newPassword;
    private $newPasswordConfirm;

    /**
     * @return mixed
     */
    public function getOldPassword()
    {
        return $this->oldPassword;
    }

    /**
     * @param mixed $oldPassword
     */
    public function setOldPassword($oldPassword)
    {
        $this->oldPassword = $oldPassword;
    }

    /**
     * @return mixed
     */
    public function getNewPassword()
    {
        return $this->newPassword;
    }

    /**
     * @param mixed $newPassword
     */
    public function setNewPassword($newPassword)
    {
        $this->newPassword = $newPassword;
    }

    /**
     * @return mixed
     */
    public function getNewPasswordConfirm()
    {
        return $this->newPasswordConfirm;
    }

    /**
     * @param mixed $newPasswordConfirm
     */
    public function setNewPasswordConfirm($newPasswordConfirm)
    {
        $this->newPasswordConfirm = $newPasswordConfirm;
    }
}