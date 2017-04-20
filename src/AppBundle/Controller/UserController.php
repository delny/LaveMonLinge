<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\AddressType;
use AppBundle\Form\Model\UserPasswordChange;
use AppBundle\Form\PasswordChangeType;
use AppBundle\Form\ForgotPasswordType;
use AppBundle\Form\Model\UserOnlyEmail;
use AppBundle\Form\Model\UserPasswordReset;
use AppBundle\Form\ResetPasswordType;
use AppBundle\Form\UserConnectType;
use AppBundle\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class UserController extends Controller
{
    /**
     * @Route("/inscription", name="app_inscription")
     */
    public function inscriptionAction(Request $request)
    {
        if ($this->getUser())
        {
            //renvoie vers la page d'accueil
            return $this->redirectToRoute('homepage');
        }
        //recup du usermanager
        $userManager = $this->getUserManager();

        //on créer un instance de user
        $userNew = $userManager->create();

        //on construit le formulaire
        $form = $this->createForm(UserType::class, $userNew);
        $form->handleRequest($request);
        if ($form->isSubmitted() AND $form->isValid())
        {
            // si email non deja use
            if (!$userManager->getUserByEmail($userNew->getEmail()))
            {
                //encodage du mot de passe
                $encodedPassword = $this->encode($userNew,$userNew->getPassword());
                $userNew->setPassword($encodedPassword);

                //ajout du user à la bdd
                $userManager->save($userNew);

                //message de notification
                $this->addFlash(
                    'success',
                    'Vous êtes bien inscrit !'
                );

                //renvoie vers la page d'accueil
                return $this->redirectToRoute('homepage');
            }
            else
            {
                //message de notification
                $this->addFlash(
                    'danger',
                    'cet email est déjà pris !'
                );
            }


        }

        return $this->render(':user:inscription.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/signin", name="app_connexion")
     */
    public function connexionAction(Request $request)
    {
        $authenticationUtils = $this->container->get('security.authentication_utils');

        //recup erreur si erreur il y a
        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();

        if ($this->getUser())
        {
            //renvoie vers la page d'accueil
            return $this->redirectToRoute('homepage');
        }
        //recup manager
        $userManager = $this->getUserManager();
        //on crée instance de user
        $user = $userManager->create();

        //on construit le formulaire
        $form = $this->createForm(UserConnectType::class, $user);
        $form->handleRequest($request);

        return $this->render(':user:signin.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/logout",name="app_logout")
     */
    public function logoutAction(Request $request)
    {
        //renvoie vers la page d'accueil
        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/account",name="app_my_account")
     */
    public function configAction(Request $request)
    {
        //recup manager
        $addressManager = $this->container->get('app.address_manager');

        //on creer instance de address
        $address = $addressManager->create();

        //on constuit le formulaire
        $form = $this->createForm(AddressType::class,$address);
        $form->handleRequest($request);

        if ($form->isSubmitted() AND $form->isValid())
        {
            //si le formulaire est valide

            //ajout du user dans l'adresse
            $address->setUser($this->getUser());

            //ajout de adresse à la bdd
            $addressManager->save($address);

            //message de notification
            $this->addFlash(
                'success',
                'Votre adresse a bien été ajouté !'
            );

            //renvoie vers la page d'accueil
            return $this->redirectToRoute('app_my_account');
        }

        return $this->render(':user:account.html.twig', array(
            'form' => $form->createView(),
        ));
    }

  
  /**
  * @Route("/passchange", name="app_password_change")
  */
  public function changePasswordAction(Request $request)
  {
    //recup manager
    $userManager = $this->getUserManager();
    //on recup instance
    $userPasswordChange = new UserPasswordChange();

    //on construit le formulaire
    $form = $this->createForm(PasswordChangeType::class, $userPasswordChange);
    
    if ($form->isSubmitted() AND $form->isValid())
        {
          $encoder = $this->container->get('security.password_encoder');

          $error = FALSE;

          if (!$encoder->isPasswordValid($this->getUser(), $userPasswordChange->getOldPassword()))
          {
              $error = TRUE;
              //message de notification
              $this->addFlash(
                  'danger',
                  'Le mot de passe n\'est pas correct !'
              );
          }

          if ($userPasswordChange->getNewPassword() != $userPasswordChange->getNewPasswordConfirm())
          {
              $error = TRUE;
              //message de notification
              $this->addFlash(
                  'danger',
                  'les nouveaux mots de passe ne correspondent pas !'
              );
          }

          if (!$error)
          {
              $userManager->changePassword($this->getUser(),$userPasswordChange,$encoder);
            }
        }

        return $this->render(':user:passwordChange.html.twig', array(
          'form' => $form->createView(),
        ));
  }
  
    /**
     * @Route("/forgotpassword", name="app_forgot_password")
     */
    public function forgotPasswordAction(Request $request)
    {
        //recup manager
        $userManager = $this->getUserManager();

        //instance de user
        $userToReset = new UserOnlyEmail();

        //consctuction formulaire
        $form = $this->createForm(ForgotPasswordType::class,$userToReset);

        $form->handleRequest($request);

        if ($form->isSubmitted() AND $form->isValid())
        {
            $user = $userManager->getUserByEmail($userToReset->getEmail());
            if ($user)
            {
                $token = $userManager->CreateTokenToResetPassword($user);
                $this->sendMessageToResetPassword($user,$token);
                //message de notification
                $this->addFlash(
                    'success',
                    'Un lien vous a été envoyé pour réinitialiser votre mot de passe!'
                );
                return $this->redirectToRoute('homepage');
            }
            else
            {
                //message de notification
                $this->addFlash(
                    'danger',
                    'l\'email renseignée est inconnue !'
                );
            }
        }

        return $this->render(':user:forgotPassword.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route(
     *     "/verifyresetpassword/{id}/{token}",
     *     defaults={"id": "null","token": "null"},
     *     requirements={
     *     "id": "\d+"
     *      }
     * )
     *
     */
    public function verifResetPasswordAction($id,$token)
    {
        //manager
        $userManager = $this->getUserManager();

        //recup user by id
        $user = $userManager->getUserById($id);

        if ($user AND $userManager->verifyTokenToResetPassword($user,$token))
        {
            //on peut rediriger ver changement de mot de passe
            $session = new Session();
            $session->set('idUserToResetPassword', $id);
            //$_SESSION['idUserToResetPassword'] = $id;
            //renvoie vers la page de reset password
            return $this->redirectToRoute('app_reset_paswword');
        }
        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/resetpassword", name="app_reset_paswword")
     */
    public function resetPasswordAction(Request $request)
    {
        //appel manager
        $userManager = $this->getUserManager();

        //recup idUser de session
        $session = new Session();
        $idUser = $session->get('idUserToResetPassword');

        //recup user to reset password
        $user = $userManager->getUserById($idUser);

        if(!$user)
        {
            return $this->redirectToRoute('homepage');
        }

        //instance de model
        $userPasswordReset = new UserPasswordReset();

        //formulaire
        $form = $this->createForm(ResetPasswordType::class,$userPasswordReset);
        $form->handleRequest($request);

        if ($form->isSubmitted() AND $form->isValid())
        {
            $encoder = $this->container->get('security.password_encoder');

            if ($userPasswordReset->getNewPassword() != $userPasswordReset->getNewPasswordConfirm())
            {
                //message de notification
                $this->addFlash(
                    'danger',
                        'les nouveaux mots de passe ne correspondent pas !'
                );
            }
            else
            {
                $userManager->resetPassword($user,$userPasswordReset,$encoder);

                $this->addFlash(
                    'success',
                    'Votre mot de passe a été modifié avec succès'
                );
                $session->set('idUserToResetPassword',null);
                return $this->redirectToRoute('homepage');
            }
        }

        return $this->render(':user:resetPassword.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /*Fonctions en privées utilisées par les actions ci-dessus*/

    /**
     * @return \AppBundle\Manager\UserManager|object
     */
    private function getUserManager()
    {
        return $this->container->get('app.user_manager');
    }

    /**
     * @param $user
     * @param $plainPassword
     * @return string
     */
    private function encode($user,$plainPassword)
    {
        $encoder = $this->container->get('security.password_encoder');
        $encoded = $encoder->encodePassword($user, $plainPassword);

        return $encoded;
    }

    private function sendMessageToResetPassword(User $user,$token)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('Hello Email')
            ->setFrom('send@example.com')
            ->setTo('recipient@example.com')
            ->setBody(
                $this->render(
                // app/Resources/views/Emails/registration.html.twig
                    ':Email:emailResetPassword.twig.html',
                    array('id' => $user->getId(), 'token' => $token)
                ),
                'text/html'
            );
        $this->get('mailer')->send($message);
    }

}