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
     * @Route("/account",name="app_my_account")
     */
    public function configAction(Request $request)
    {
        //recup manager
        $addressManager = $this->container->get('app.address_manager');

        //on creer instance de address
        $address = $addressManager->create();

        //on constuit le formulaire
        $form = $this->createForm(AddressType::class, $address);
        $form->handleRequest($request);


        if ($form->isSubmitted() AND $form->isValid()) {
            $iduser = $this->getUser()->getId();
            $type = $form->getNormData()->getType();
            if ($form->getNormData()->getCp() === null || $form->getNormData()->getCity() === null || $form->getNormData()->getStreet() === null ||
                $form->getNormData()->getStreetNumber() === null
            ) {
                $this->addFlash(
                    'warning',
                    'Il y a une erreur dans l\'addresse que vous venez de soumettre.'

                );

            } else {

                if (!$addressManager->getAddressByUserAndType($iduser, $type)) {


                    //ajout du user dans l'adresse
                    $address->setUser($this->getUser());

                    //ajout de adresse à la bdd
                    $addressManager->save($address);

                    //message de notification
                    $this->addFlash(
                        'success',
                        'Votre adresse a bien été ajoutée !'
                    );

                    //renvoie vers la page du compte
                    return $this->redirectToRoute('app_my_account');
                } //Modification de l'adresse existante
                else {
                    $updateAddress = $addressManager->getAddressByUserAndType($iduser, $type);
                    $updateAddress->setStreet($address->getStreet());
                    $updateAddress->setStreetNumber($address->getStreetNumber());
                    $updateAddress->setCity($address->getCity());
                    $updateAddress->setCp($address->getCp());
                    $addressManager->save($updateAddress);

                    //message de notification
                    $this->addFlash(
                        'success',
                        'Votre adresse a bien été modifiée !'
                    );


                    return $this->redirectToRoute('app_my_account');
                }
            }
        }

        return $this->render(':user:account.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/address",name="app_address")
     */
    public function workflowAction(Request $request)
    {
        //recup manager
        $addressManager = $this->container->get('app.address_manager');

        //on creer instance de address
        $address = $addressManager->create();

        //on constuit le formulaire
        $form = $this->createForm(AddressType::class, $address);
        $form->handleRequest($request);


        if ($form->isSubmitted() AND $form->isValid()) {
            $iduser = $this->getUser()->getId();
            $type = $form->getNormData()->getType();
            if ($form->getNormData()->getCp() === null || $form->getNormData()->getCity() === null || $form->getNormData()->getStreet() === null ||
                $form->getNormData()->getStreetNumber() === null
            ) {
                $this->addFlash(
                    'warning',
                    'Il y a une erreur dans l\'addresse que vous venez de soumettre.'

                );

            } else {

                if (!$addressManager->getAddressByUserAndType($iduser, $type)) {


                    //ajout du user dans l'adresse
                    $address->setUser($this->getUser());

                    //ajout de adresse à la bdd
                    $addressManager->save($address);

                    //message de notification
                    $this->addFlash(
                        'success',
                        'Votre adresse a bien été ajoutée !'
                    );

                    //renvoie vers la page du compte
                    return $this->redirectToRoute('app_address');
                } //Modification de l'adresse existante
                else {
                    $updateAddress = $addressManager->getAddressByUserAndType($iduser, $type);
                    $updateAddress->setStreet($address->getStreet());
                    $updateAddress->setStreetNumber($address->getStreetNumber());
                    $updateAddress->setCity($address->getCity());
                    $updateAddress->setCp($address->getCp());
                    $addressManager->save($updateAddress);

                    //message de notification
                    $this->addFlash(
                        'success',
                        'Votre adresse a bien été modifiée !'
                    );


                    return $this->redirectToRoute('app_address');
                }
            }
        }

                return $this->render(':user:account.html.twig', array(
                    'form' => $form->createView(),
                ));
    }





    private function getManager($manager){
        return $this->get($manager);
    }




}