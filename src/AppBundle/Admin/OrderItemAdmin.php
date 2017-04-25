<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\Filter\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class OrderItemAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form)
    {
        $form->add('statut',ChoiceType::class, array(
            'choices' => [
                'réception du colis' => 'réception du colis',
                'lavage en cours' => 'lavage en cours',
                'expédition' => 'expédition',
            ],
        ));
    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter->add('product');
        $filter->add('orderLaundry');
        $filter->add('statut');
        $filter->add('qte');
        $filter->add('barcode');
    }

    protected function configureListFields(ListMapper $list)
    {
        $list->add('product');
        $list->add('orderLaundry');
        $list->addIdentifier('statut');
        $list->add('qte');
        $list->add('barcode');
    }
}