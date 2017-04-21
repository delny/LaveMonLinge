<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Address;
use AppBundle\Form\AddressType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class AddressController extends Controller
{
    /**
     * @Route("/email", name="app_email")
     */
    public function addressAction(Request $request)
    {

        $addManager = $this->get('app.address_manager');
        $form = $this->createForm(AddressType::class, $addressNew);
        $form->handleRequest($request);
        if ($form->isSubmitted() AND $form->isValid()) {


        }
    }


    private function getManager($manager){
        return $this->get($manager);
    }




}