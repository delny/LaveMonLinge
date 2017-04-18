<?php

namespace AppBundle\Admin;

use AppBundle\Entity\ProductType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\Filter\ChoiceType;

class ProductAdmin extends AbstractAdmin
{

    /**
     * @param FormMapper $form
     */
    protected function configureFormFields(FormMapper $form)
    {
        $productTypeManager = $this->getConfigurationPool()->getContainer()->get('app.producttype_manager');
        $productTypeList = $productTypeManager->getListTypeProduct();
        $productTypePressing = $productTypeList[1];

        //Fait référence aux formulaires de créations et d'update
        $form->add('name', 'text');
        $form->add('price','number');

        $form->add('type',\Symfony\Component\Form\Extension\Core\Type\ChoiceType::class, array(
            'choices' => $productTypeList,
            'choice_label' => 'name',
        ));
        $form->add('img','file',array(
            'required' => true
        ));
    }

    /**
     * @param DatagridMapper $filter
     */
    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter->add('name');
        $filter->add('price');
        //$filter->add('type');
        $filter->add('img');
    }

    /**
     * @param ListMapper $list
     */
    protected function configureListFields(ListMapper $list)
    {
        $list->addIdentifier('name');
        $list->add('price');
        //$list->add('type');
        $list->add('img');
    }

    /**
     * @param mixed $image
     */
    public function prePersist($image)
    {
        $this->manageFileUpload($image);
    }

    /**
     * @param mixed $image
     */
    public function preUpdate($image)
    {
        $this->manageFileUpload($image);
    }

    /**
     * @param $image
     */
    private function manageFileUpload($image)
    {
        $image->setFile($image->getImg());
        if ($image->getFile()) {
            $image->upload();
        }
    }
}