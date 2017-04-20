<?php

namespace AppBundle\Form;

use AppBundle\Entity\TimeSlot;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DateChoiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('date', TextType::class,[
                        'required' => true,
                    ])
                ->add('heureCollecte', EntityType::class,[
                    'class' => TimeSlot::class,
                    'required' => true,
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                            ->where('u.isAvailable = 1');
                    },
                    'label' => 'Heure de collecte'
                ])
                ->add('heureLivraison', EntityType::class,[
                'class' => TimeSlot::class,
                'required' => true,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->where('u.isAvailable = 1');
                },
                'label' => 'Heure de livraison'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'app_bundle_date_choice_type';
    }
}
