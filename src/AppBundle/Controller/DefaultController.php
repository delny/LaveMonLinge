<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $user = $this->getUser();
        // replace this example code with whatever you need
        return $this->render(':panier:panier.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
            'user' => $user,
        ]);
    }

    /**
     * @return \AppBundle\Manager\UserManager|object
     */
    private function getUserManager()
    {
        return $this->container->get('app.user_manager');
    }
}
