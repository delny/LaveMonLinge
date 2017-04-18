<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class OrderLaundryAdmin extends AbstractAdmin
{
    /**
     * @param FormMapper $form
     */
    protected function configureFormFields(FormMapper $form)
    {
        $userManager = $this->configurationPool->getContainer()->get('app.user_manager');
        $usersList = $userManager->getAllUsers();

        $form->add('user',\Symfony\Component\Form\Extension\Core\Type\ChoiceType::class, array(
            'choices' => $usersList,
            'choice_label' => 'name',
        ));
        $form->add('statut','text');
        $form->add('total','number');
    }

    /**
     * @param DatagridMapper $filter
     */
    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter->add('user');
        $filter->add('status');
        $filter->add('total');
    }

    /**
     * @param ListMapper $list
     */
    protected function configureListFields(ListMapper $list)
    {
        $list->add('user');
        $list->add('status');
        $list->add('total');
    }
}