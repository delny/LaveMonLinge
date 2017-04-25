<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PlanningController extends Controller
{
    /**
     * @Route("/planning", name="planning")
     */
    public function indexAction()
    {

        return $this->render(':planning:planning.html.twig', []);
    }


}
