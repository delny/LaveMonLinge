<?php

namespace AppBundle\Admin;

use AppBundle\AppBundle;
use AppBundle\Entity\ProductType;
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
        $form->add('type_id','sonata_type_model', array(
            'class' => ProductType::class
        ));
        $form->add('img','file',array(
            'required' => true
        ));
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
        $list->add('img');
    }

    public function prePersist($image)
    {
        $this->manageFileUpload($image);
    }

    public function preUpdate($image)
    {
        $this->manageFileUpload($image);
    }

    private function manageFileUpload($image)
    {
        $image->setFile($image->getImg());
        if ($image->getFile()) {
            $image->upload();
        }
    }
}