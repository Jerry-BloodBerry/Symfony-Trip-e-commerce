<?php


namespace App\Form;


use Symfony\Component\Form\AbstractType;
use App\Entity\CustomersRating;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RateBookingOfferType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('rate', IntegerType::class, [
                'required' => true,
                'label' => 'Your rating',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('comment', TextType::class, [
                'required' => false,
                'label' => 'Comment',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Rate offer',
                'attr' => [
                    'class' => 'btn btn-login'
                ]
            ]);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CustomersRating::class
        ]);
    }
}