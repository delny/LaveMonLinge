<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
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

        $form->add('user',ChoiceType::class, array(
            'choices' => $usersList,
            'choice_label' => 'email',
        ));
        $form->add('statut','text');
        $form->add('total','number');
        $form->add('dateCollect','date');
        $form->add('dateDelivery','date');
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
    }
}