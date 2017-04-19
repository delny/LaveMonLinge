<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\CoreBundle\Validator\ErrorElement;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class OrderLaundryAdmin extends AbstractAdmin
{
    /**
     * @param FormMapper $form
     */
    protected function configureFormFields(FormMapper $form)
    {
        $userManager = $this->configurationPool->getContainer()->get('app.user_manager');
        $usersList = $userManager->getAllUsers();

        $priceDelivery = $this->configurationPool->getContainer()->getParameter('price_delivery');

        $form->add('user',ChoiceType::class, array(
            'choices' => $usersList,
            'choice_label' => 'email',
        ));
        $form->add('statut',ChoiceType::class, array(
            'choices' => [
                'Validé' => 'Validé',
                'Receptionné' => 'Receptionné',
                'Lavé' => 'Lavé',
                'Expédié' => 'Expédié',
                'Remis' => 'Remis',
            ],
        ));
        $form->add('total','number');
        $form->add('dateCollect','datetime');
        $form->add('dateDelivery','datetime');
        $form->add('priceDelivery','hidden',array(
           'data' => $priceDelivery,
        ));
    }

    /**
     * @param DatagridMapper $filter
     */
    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter->add('user.email');
        $filter->add('statut');
        $filter->add('total');
        $filter->add('dateCollect');
        $filter->add('dateDelivery');
        $filter->add('priceDelivery');
    }

    /**
     * @param ListMapper $list
     */
    protected function configureListFields(ListMapper $list)
    {
        $list->add('user.email');
        $list->add('statut');
        $list->add('total');
        $list->add('dateCollect');
        $list->add('dateDelivery');
        $list->add('priceDelivery');
    }

    public function validate(ErrorElement $errorElement, $object)
    {
        //dump($object);
        //exit();
        $errorElement->with('priceDelivery')
            ->assertNotBlank()
            ->assertLength(array('max' => 1))
            ->end();
        $errorElement->with('total')
            ->assertNotBlank()
            ->end();

        if(!$this->validateDatesForm($object->getDateCollect(),$object->getDateDelivery()))
        {
            $errorElement
                ->with('dateCollect')
                ->addViolation('Erreur de date de collecte et/ou de date de livraison')
                ->end();
        }

    }

    private function validateDatesForm($dateCollecte,$dateLivraison)
    {
        $dateToday = new \DateTime();

        if ($dateCollecte >= $dateLivraison)
        {
            return FALSE;
        }

        if ($dateToday >= $dateCollecte)
        {
            return FALSE;
        }

        return TRUE;
    }
}