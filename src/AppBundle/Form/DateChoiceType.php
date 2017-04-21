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

        $date = new \DateTime();
        $hourNow = $date->format('H');

        $builder->add('dateCollect', TextType::class,[
                        'required' => true,
                    ])
                ->add('hourCollect', EntityType::class,[
                    'class' => TimeSlot::class,
                    'required' => true,
                    'query_builder' => function (EntityRepository $er) use ($hourNow) {
                        return $er->createQueryBuilder('u')
                            ->andWhere('u.isAvailable = 1')
                            ->andWhere('u.slotStart >= :now')
                            ->setParameter('now', $hourNow);
                    },
                    'label' => 'Heure de collecte'
                ])
                ->add('dateDelivery', TextType::class,[
                    'required' => true,
                ])
                ->add('hourDelivery', EntityType::class,[
                'class' => TimeSlot::class,
                'required' => true,
                'query_builder' => function (EntityRepository $er) use ($hourNow){
                    return $er->createQueryBuilder('u')
                        ->andWhere('u.isAvailable = 1')
                        ->andWhere('u.slotStart >= :now')
                        ->setParameter('now', $hourNow);
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
