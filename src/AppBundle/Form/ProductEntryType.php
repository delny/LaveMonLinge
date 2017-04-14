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
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductEntryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $productType = $options['productType'];
        $builder
            ->add('products', EntityType::class, [
            'class' => Product::class,
            'query_builder' => function (EntityRepository $er) use ($productType) {
                return $er->createQueryBuilder('u')
                    ->where('u.type = :productTypeId')
                    ->setParameter('productTypeId', $productType->getId());
            },
        ]);

        if($productType->getComputePriceByWeight()) {
            $builder->add('quantity', ChoiceType::class, [
                'choices' => [
                    50 => 50,
                    3 => 3
                ],
            ]);
        }
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
