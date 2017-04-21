<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ProductType;
use AppBundle\Form\CardType;
use AppBundle\Form\DateChoiceType;
use AppBundle\Form\Model\Card;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CardController extends Controller
{
    /**
     * @Route("/form/{id}", name="app_form_card")
     */
    public function formAction(Request $request, ProductType $productType)
    {
        $form = $this->createForm(CardType::class, new Card(), ['productType' => $productType]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getManager('app.basket_manager')->addToBasket($form->getData());

            return $this->redirectToRoute('app_form_date_card', ['id' => $productType->getId()]);
        }
        return $this->render(':lavage:list.html.twig', array('form' => $form->createView()));
    }


    /**
     * @Route("/form/{id}/date", name="app_form_date_card")
     */
    public function formDatePickerAction(Request $request){
        $form = $this->createForm(DateChoiceType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // ici entrée en BDD de l'order


            //$this->getManager('app.basket_manager')->addToBasket($form->getData());
            //return $this->redirectToRoute('app_showBasket');
        }
        return $this->render(':date:date.html.twig', array('form' => $form->createView()));
    }


    private function getManager($manager){
        return $this->get($manager);
    }
}
