<?php

namespace AppBundle\Form\Model;

class UserPasswordReset
{
    private $newPassword;
    private $newPasswordConfirm;

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