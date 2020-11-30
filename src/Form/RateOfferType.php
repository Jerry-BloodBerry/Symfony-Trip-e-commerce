<?php


namespace App\Form;


use Symfony\Component\Form\AbstractType;
use App\Entity\CustomersRating;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RateOfferType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('rating', NumberType::class, [
                'required' => true,
                'label' => 'Your rating',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Your rating'
                ],
            ])
            ->add('comment', TextType::class, [
                'required' => false,
                'label' => 'Comment',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Comment'
                ],
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