<?php

namespace AppBundle\Controller;

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
        //recup du usermanager
        $userManager = $this->container->get('app.user_manager');
        //on créer un instance de user
        $user = $userManager->create();

        //on construit le formulaire
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() AND $form->isValid())
        {
            //si le formulaire est valide

            //encodage du mot de passe
            $plainPassword = $user->getPassword();
            $encoder = $this->container->get('security.password_encoder');
            $encoded = $encoder->encodePassword($user, $plainPassword);
            $user->setPassword($encoded);

            //ajout du user à la bdd
            $userManager->save($user);

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
        //recup manager
        $userManager = $this->container->get('app.user_manager');
        //on crée instance de user
        $user = $userManager->create();

        //on construit le formulaire
        $form = $this->createForm(UserConnectType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() AND $form->isValid())
        {
            $userExist = $userManager->getUserByEmail($user->getEmail());

            //mot de passe encodé
            $plainPassword = $user->getPassword();
            $encoder = $this->container->get('security.password_encoder');
            $encoded = $encoder->encodePassword($user, $plainPassword);

            if ($userExist->getPassword() == $encoded)
            {
                //connexion reussie
                //message de notification
                $this->addFlash(
                    'success',
                    'Vous vous êtes connecté avec succès !'
                );
                //renvoie vers la page d'accueil
                return $this->redirectToRoute('homepage');
            }
            else
            {
                $this->addFlash(
                    'danger',
                    'Erreur de login et/ou de mot de passe!'
                );
            }
        }

        return $this->render(':user:signin.html.twig', array(
            'form' => $form->createView(),
        ));

    }
}