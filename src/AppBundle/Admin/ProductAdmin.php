<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ProductAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form)
    {
        //Fait référence aux formulaires de créations et d'update
        $form->add('name', 'text');
        $form->add('price','number');
        $form->add('type_id','number');
        $form->add('img','text');
    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter->add('name');
        $filter->add('price');
        $filter->add('type_id');
        $filter->add('img');
    }

    protected function configureListFields(ListMapper $list)
    {
        $list->addIdentifier('name');
        $list->add('price');
        $list->add('type_id');
        $list->add('imd');
    }
}