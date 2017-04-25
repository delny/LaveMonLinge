<?php

namespace AppBundle\Form;

use AppBundle\Entity\Product;
use AppBundle\Entity\ProductType;
use AppBundle\Form\Model\Card;
use AppBundle\Form\Model\CardEntry;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CardType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
            $builder->add('products', CollectionType::class, [
                'entry_type' => ProductEntryType::class,
                'entry_options' => [
                  'productType' => $options['productType'],
                ],
                'allow_add' => true,
            ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
           'data_class' => Card::class,
        ));
        $resolver->setRequired(['productType']);
        $resolver->setAllowedTypes('productType',ProductType::class);
    }


}