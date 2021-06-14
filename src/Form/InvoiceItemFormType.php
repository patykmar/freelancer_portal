<?php

namespace App\Form;

use App\Entity\InvoiceItem;
use App\Entity\Vat;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PercentType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InvoiceItemFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => array(
                    'class' => 'form-control',
                    'maxlength' => 255,
                    'placeholder' => 'Název položky'
                ),
                'label' => 'Název položky',
            ])
            ->add('unit_count', NumberType::class, [
                'label' => 'Počet jednotek',
                'data' => 1.0,
                'attr' => [
                    'min' => 0.01,
                    'max' => 99999.99,
                    'step' => 0.25,
                ],
                'html5' => true,
            ])
            ->add('price', MoneyType::class, [
                'currency' => 'CZK',
                'help' => 'Cena za kus',
                'required' => true,
                'divisor' => 100,
                'data' => 100
            ])
            ->add('discount', PercentType::class, [
                'label' => 'Sleva',
                'help' => 'Vyjádřená v procentech',
                'type' => 'integer',
                'data' => 0,
                'attr' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => 1
                ],
                'html5' => true,
            ])
            ->add('margin', PercentType::class, [
                'label' => 'Marže',
                'help' => 'Procentuální vyjádření marže',
                'type' => 'integer',
                'data' => 0,
                'attr' => [
                    'min' => 0,
                    'max' => 9999,
                    'step' => 10,
                ],
                'html5' => true,
            ])
            ->add('vat', EntityType::class, [
                'label' => 'DPH',
                'class' => Vat::class
            ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => InvoiceItem::class,
        ]);
    }
}
