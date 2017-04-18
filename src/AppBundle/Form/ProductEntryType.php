<?php

namespace AppBundle\Form;

use AppBundle\Entity\Product;
use AppBundle\Entity\ProductType;
use AppBundle\Form\Model\CardEntry;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductEntryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $productType = $options['productType'];

        if($productType->getComputePriceByWeight()) {
            $builder->add('quantity', ChoiceType::class, [
                'choices' => [
                    50 => 50,
                    3 => 3
                ],
            ]);
        }else{
            $builder
                ->add('product', EntityType::class, [
                    'class' => Product::class,
                    'query_builder' => function (EntityRepository $er) use ($productType) {
                        return $er->createQueryBuilder('u')
                            ->where('u.type = :productTypeId')
                            ->setParameter('productTypeId', $productType->getId());
                    },
                    'empty_data' => '',
                    'required' => false,
                ]);
        }
        $listener = function (FormEvent $event) {
            $form = $event->getForm();
            $data = $event->getData();
            $productType = $form->getConfig()->getOption('productType');

            if($productType->getComputePriceByWeight()) {
                if($productType->getProducts()->count()){
                    $data->setProduct($productType->getProducts()->first());
                }

                $form->add('quantity', ChoiceType::class, [
                    'choices' => [
                        50 => 50,
                        3 => 3
                    ],
                ]);
            }
        };
        $builder->addEventListener(FormEvents::PRE_SET_DATA, $listener);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => CardEntry::class,
            'data' => new CardEntry(),
        ));
        $resolver->setRequired(['productType']);
        $resolver->setAllowedTypes('productType',ProductType::class);
    }

}
