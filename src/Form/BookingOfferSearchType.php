<?php

namespace App\Form;

use App\Entity\BookingOffer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookingOfferSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('departureDate', TextType::class, [
                'attr' => [
                    'class' => 'form-control datepicker',
                    'placeholder' => "Depart Date"
                ],
                'label_attr' => [
                    'class' => 'sr-only'
                ],
                'required' => false
            ])
            ->add('comebackDate', TextType::class, [
                'attr' => [
                    'class' => 'form-control datepicker',
                    'placeholder' => 'Return Date'
                ],
                'label_attr' => [
                    'class' => 'sr-only'
                ],
                'required' => false
            ])
            ->add('departureSpot', ChoiceType::class, [
                'choices' => [
                    'From' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                ],
                'label_attr' => [
                    'class' => 'sr-only'
                ],
                'required' => false
            ])
            ->add('destination', ChoiceType::class, [
                'choices' => [
                    'To' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                ],
                'label_attr' => [
                    'class' => 'sr-only'
                ],
                'required' => false
            ])
            ->add('submit', SubmitType::class, [
                'label' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BookingOffer::class,
            'destinations' => []
        ]);
    }
}
