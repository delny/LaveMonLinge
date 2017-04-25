<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ProductType;
use AppBundle\Form\CardType;
use AppBundle\Form\DateChoiceType;
use AppBundle\Form\Model\Card;
use AppBundle\Form\Model\DateChoice;
use Doctrine\ORM\Query\Expr\Math;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CardController extends Controller
{
    /**
     * @Route("/form/{name}", name="app_form_card")
     */
    public function formAction(Request $request, ProductType $productType)
    {
        $form = $this->createForm(CardType::class, new Card(), ['productType' => $productType]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $this->getManager('app.basket_manager')->addToBasket($form->getData());
            return $this->redirectToRoute('app_form_date_card', ['name' => $productType->getName()]);
        }
        return $this->render(':lavage:list.html.twig', array('form' => $form->createView()));
    }


    /**
     * @Route("/form/{name}/date", name="app_form_date_card")
     */
    public function formDatePickerAction(Request $request){
        $basket = $this->getManager('app.basket_manager')->getBasket();
        $basket->setHourCollect(null);
        $basket->setHourDelivery(null);
        $form = $this->createForm(DateChoiceType::class,$basket);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dateCollect =$form->getData()->getDateCollect();
            $dateDelivery = $form->getData()->getDateDelivery();
            $dateCollectString = strtotime($dateCollect);
            $dateCollectFormated = date('d', $dateCollectString);
            $dateDeliveryString = strtotime($dateDelivery);
            $dateDeliveryFormated = date('d-m-Y', $dateDeliveryString);
            $dateDeliveryWeekEnd = date('w',strtotime($dateDeliveryFormated));


            $joursFeries = $this->JoursFeries(2017);
            $type = $form->getData()->getProducts()[0]->getProduct()->getType()->getName();
            $hourNow = date('H:i');
            $dateNow = date('d');

            $hourCollect = $form->getData()->getHourCollect()->getSlotStart();
            if($dateNow == $dateCollectFormated && $type == "pressing"){
                if($hourNow > $hourCollect){
                    $this->get('session')->getFlashBag()->add('danger', 'l\'heure de collecte doit etre superieure a l\'heure actuelle');
                    return $this->redirect($_SERVER['HTTP_REFERER']);
                }
                $test = strtotime($dateCollect. ' + 5 days');
                $t = date('d-m-Y', $test);
                if($dateDelivery > $t){
                    $this->get('session')->getFlashBag()->add('danger', 'la date n\'est pas valide pressing');
                    $basket->setDateCollect(null);
                    $basket->setDateDelivery(null);
                    return $this->redirect($_SERVER['HTTP_REFERER']);
                }
            }elseif($type == "laverie"){
                $dateDeliveryLaverie = strtotime($dateCollect. ' + 3 days');
                $dateDeliveryLaverieFormated = date('d-m-Y', $dateDeliveryLaverie);
                if($dateDelivery > $dateDeliveryLaverieFormated){
                    $this->get('session')->getFlashBag()->add('danger', 'la date n\'est pas valide laverie');
                    $basket->setDateCollect(null);
                    $basket->setDateDelivery(null);
                    return $this->redirect($_SERVER['HTTP_REFERER']);
                }
            }

            if (in_array($dateDelivery, $joursFeries) || $dateDeliveryWeekEnd == 0) {
                $basket->setDateCollect(null);
                $basket->setDateDelivery(null);
                $this->get('session')->getFlashBag()->add('danger', 'la date de retour n\'est pas valide ');
                return $this->redirect($_SERVER['HTTP_REFERER']);
            }
            else {
                $this->getManager('app.basket_manager')->addToBasket($form->getData());
                return $this->redirectToRoute('app_address');
            }
        }
        return $this->render(':date:date.html.twig', array('form' => $form->createView()));
    }


    private function getManager($manager){
        return $this->get($manager);
    }

    private function JoursFeries($an){
        $JourAn = new \Datetime($an.'-01-01');
        $FeteTravail = new \Datetime($an.'-05-01');
        $Victoire1945 = new \Datetime($an.'-05-08');
        $FeteNationale = new \Datetime($an.'-07-14');
        $Assomption = new \Datetime($an.'-08-15');
        $Toussaint = new \Datetime($an.'-11-01');
        $Armistice = new \Datetime($an.'-11-11');
        $Noel = new \Datetime($an.'-12-25');
        $G = $an % 19;
        $C = floor($an / 100);
        $H = ($C - floor($C / 4) - floor((8 * $C + 13) / 25) + 19 * $G + 15) % 30;
        $I = $H - floor($H / 28) * (1 - floor($H / 28) * floor(29 / ($H + 1)) * floor((21 - $G) / 11));
        $J = ($an * 1 +floor($an / 4) + $I + 2 - $C + floor($C / 4)) % 7;
        $L = $I - $J;
        $MoisPaques = 3 + floor(($L + 40) / 44);
        $JourPaques = $L + 28 - 31 * floor($MoisPaques / 4);
        $Paques = new \Datetime($an.'-'.$MoisPaques.'-'.$JourPaques);
        $VendrediSaint = new \Datetime($an.'-'.$MoisPaques.'-'.($JourPaques -2));
        $LundiPaques = new \Datetime($an.'-'.$MoisPaques.'-'.($JourPaques + 1));
        $Ascension = new \Datetime($an.'-'.($MoisPaques + 1).'-'.($JourPaques + 9));
        //$Pentecote = new \Datetime($an.'-'.$MoisPaques.'-'.($JourPaques + 49));
        //$LundiPentecote = new \Datetime($an.'-'.$MoisPaques.'-'.$JourPaques + 50);

        return [$Paques->format('d-m-Y'),$LundiPaques->format('d-m-Y'),$Ascension->format('d-m-Y'),$JourAn->format('d-m-Y'),$FeteTravail->format('d-m-Y'),$Victoire1945->format('d-m-Y'),$FeteNationale->format('d-m-Y'),$Assomption->format('d-m-Y'),$Toussaint->format('d-m-Y'),$Armistice->format('d-m-Y'),$Noel->format('d-m-Y')];
    }
}
