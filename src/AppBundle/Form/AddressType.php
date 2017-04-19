<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('streetNumber', HiddenType::class)
            ->add('street', HiddenType::class)
            ->add('cp', HiddenType::class)
            ->add('city', HiddenType::class)
            ->add(
                'type', ChoiceType::class, [
                 'choices' => [
                     'Facturation' => 'Facturation',
                     'Récupération' => 'Récupération',
                     'Remise' => 'Remise',
                 ]
                ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Address'
        ));
    }
}