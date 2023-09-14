<?php

namespace App\Form;

use App\Entity\Participant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class ParticipantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, [
                'constraints' => new NotBlank(),
                'label' => "Prénom"
            ])
            ->add('name', TextType::class, [
                'constraints' => new NotBlank(),
                'label' => "Nom"
            ])
            ->add('email', EmailType::class, [
                'constraints' => new NotBlank(),
                'label' => "Adresse e-mail"
            ])
            ->add('birthDate', DateType::class, [
                'constraints' => new NotBlank(),
                'widget' => 'single_text',
                'label' => "Date de naissance"
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Participant::class,
        ]);
    }
}
