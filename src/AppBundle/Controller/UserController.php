<?php

namespace AppBundle\Controller;

use AppBundle\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    /**
     * @Route("/inscription", name="app-inscription")
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
            //ajout du user à la bdd
            $userManager->save($user);

            //message de notification
            $this->addFlash(
                'success',
                'Vous êtes bien inscrit !'
            );

        }

        return $this->render(':user:inscription.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}