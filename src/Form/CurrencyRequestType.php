<?php

namespace App\Form;

use App\Entity\CurrencyRequest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CurrencyRequestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('origin_currency', ChoiceType::class, [
                'choices'  => [
                    'Euro (EUR)' => "EUR"
                ]
            ])
            ->add('target_currency', ChoiceType::class, [
                'choices'  => [
                    'Dollar (USD)' => "USD",
                    'Pounds (GBP)' => "GBP",
                    'Australian Dollar (AUD)' => "AUD",
                    'Canadian Dollar (CAD)' => "CAD",
                    'Mexican Peso (MXN)' => "MXN",
                ]
            ])
            ->add('amount')
            ->add('request_date')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CurrencyRequest::class,
        ]);
    }
}
