<?php

namespace AppBundle\Controller;

use AppBundle\Form\AddressType;
use AppBundle\Form\UserConnectType;
use AppBundle\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
            //si le formulaire est valide

            //encodage du mot de passe
            $encodedPassword = $this->encode($userNew,$userNew->getPassword());
            $userNew->setPassword($encodedPassword);
            $userNew->setRoles(['ROLE_USER']);

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
     * @return \AppBundle\Manager\UserManager|object
     */
    private function getUserManager()
    {
        return $this->container->get('app.user_manager');
    }

    private function encode($user,$plainPassword)
    {
        $encoder = $this->container->get('security.password_encoder');
        $encoded = $encoder->encodePassword($user, $plainPassword);

        return $encoded;
    }

}