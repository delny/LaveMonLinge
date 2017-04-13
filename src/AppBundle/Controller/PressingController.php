<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class PressingController extends Controller
{
    /**
     * @Route("/pressing", name="app_pressing_list")
     */
    public function listAction()
    {
        return $this->render(':pressing:list.html.twig', array());
    }
}
