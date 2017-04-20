<?php

namespace AppBundle\Form;

use AppBundle\Entity\TimeSlot;
use AppBundle\Form\Model\DateChoice;
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

        $now = $date->format('H');

        $builder->add('dateCollect', TextType::class,[
                        'required' => true,
                    ])

                ->add('hourCollect', EntityType::class,[
                    'class' => TimeSlot::class,
                    'required' => true,
                    'query_builder' => function (EntityRepository $er) use ($now){
                        return $er->createQueryBuilder('u')
                            ->andWhere('u.isAvailable = 1')
                            ->andWhere('u.slotStart >= :now')
                            ->setParameter('now', $now);
                    },
                    'label' => 'Heure de collecte'
                ])
                ->add('dateDelivery', TextType::class,[
                'required' => true,
                ])
                ->add('hourDelivery', EntityType::class,[
                'class' => TimeSlot::class,
                'required' => true,
                'query_builder' => function (EntityRepository $er) use ($now){
                    return $er->createQueryBuilder('u')
                        ->andWhere('u.isAvailable = 1')
                        ->andWhere('u.slotStart >= :now')
                        ->setParameter('now', $now);
                },
                'label' => 'Heure de livraison'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => DateChoice::class,
        ));
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_date_choice_type';
    }
}
