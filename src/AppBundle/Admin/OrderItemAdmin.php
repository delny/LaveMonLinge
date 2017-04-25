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
        $productManager = $this->configurationPool->getContainer()->get('app.product_manager');
        $products = $productManager->getAllProducts();

        $orderLaundryList = $this->configurationPool->getContainer()->get('app.order_manager')->getAllOrderLaundry();

        $form->add('product', ChoiceType::class, [
            'choices' => $products,
            'choice_label' => 'name',
        ]);
        $form->add('orderLaundry', ChoiceType::class, [
            'choices' => $orderLaundryList,
            'choice_label' => 'id',
        ]);
        $form->add('statut',ChoiceType::class, array(
            'choices' => [
                'Validé' => 'Validé',
                'Receptionné' => 'Receptionné',
                'Lavé' => 'Lavé',
                'Expédié' => 'Expédié',
                'Remis' => 'Remis',
            ],
        ));
        $form->add('qte', NumberType::class);
    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter->add('product');
        $filter->add('orderLaundry');
        $filter->add('statut');
        $filter->add('qte');
    }

    protected function configureListFields(ListMapper $list)
    {
        $list->add('product');
        $list->add('orderLaundry');
        $list->addIdentifier('statut');
        $list->add('qte');
    }
}