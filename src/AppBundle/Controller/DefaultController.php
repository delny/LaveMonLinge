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
        $listTypeProduct = $this->getTypeProductManager()->getListTypeProduct();
        $idProducts = [];
        foreach ($listTypeProduct as $key => $typeProduct)
        {
            $idProducts[$typeProduct->getName()] = $typeProduct->getName();
        }
        extract($idProducts);
        // retour de la vue
        return $this->render(':accueil:accueil.html.twig', [
            'idPressing' => $pressing,
            'idLaverie' => $laverie,
        ]);
    }

    /**
     * @return \AppBundle\Manager\UserManager|object
     */
    private function getUserManager()
    {
        return $this->container->get('app.user_manager');
    }

    private function getTypeProductManager()
    {
        return $this->container->get('app.producttype_manager');
    }
}
