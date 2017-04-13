<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class OptionLaundryAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        //Fait référence aux formulaires de créations et d'update
        $formMapper->add('label', 'text');
        $formMapper->add('price', 'number');

    }

    //Utilisables par les filtres
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('label');
        $datagridMapper->add('price');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('label');
        $listMapper->add('price');
    }
}