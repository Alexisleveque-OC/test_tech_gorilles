<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DeleteReservationConfirmationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('yes', SubmitType::class, [
                'label' => 'Oui !',
                'attr' => [
                    'class' => 'btn btn-danger',
                ]])
            ->add('no', ButtonType::class, [
                'label' => 'Non !',
                'attr' => [
                    'class' => 'btn btn-info',
                    'data-dismiss' => 'modal',
                    'arial-label' => 'Close'
                ]
            ]);
    }
}
