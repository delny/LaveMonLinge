<?php

namespace AppBundle\Form;

use AppBundle\Entity\OptionLaundry;
use AppBundle\Entity\Product;
use AppBundle\Entity\ProductType;
use AppBundle\Form\Model\CardEntry;
use AppBundle\Form\Type\GenderType;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductEntryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $productType = $options['productType'];

        if($productType->getComputePriceByWeight()) {
            $builder->add('quantity', ChoiceType::class);
            $builder->add('optionLaundry', EntityType::class, [
               'class' => OptionLaundry::class,
            ]);
        }else{
            $builder
                ->add('product', LineType::class, [
                    'query_builder' => function (EntityRepository $er) use ($productType) {
                        return $er->createQueryBuilder('u')
                            ->where('u.type = :productTypeId')
                            ->setParameter('productTypeId', $productType->getId());
                    },
                ]);
        }
        $listener = function (FormEvent $event) {
            $form = $event->getForm();
            $data = $event->getData();
            if(!$data){
                $data = new CardEntry();
                $event->setData($data);
            }

            $productType = $form->getConfig()->getOption('productType');

            if($productType->getComputePriceByWeight()) {
                if($productType->getProducts()->count()){
                    $data->setProduct($productType->getProducts()->first());
                }
            }
        };
        $builder->addEventListener(FormEvents::PRE_SET_DATA, $listener);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => CardEntry::class,
        ));
        $resolver->setRequired(['productType']);
        $resolver->setAllowedTypes('productType',ProductType::class);
    }
}
