<?php

namespace App\Form;

use App\Entity\Event;
use App\Entity\Reservation;
use App\Validator\Constraints\EventFull;
use App\Validator\Constraints\ParticipantAlreadyPresent;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('event', EntityType::class,[
                'class' => Event::class,
                'choice_label' => 'name',
                'label' => "Choississez un évenement : ",
                'constraints' => [
                    new EventFull(),
                    ]
            ] )
            ->add('participant', ParticipantType::class, [
                'label' => "Information sur le participant :"
            ])
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date de la participation'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
