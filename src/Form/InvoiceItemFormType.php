<?php

namespace App\Form;

use App\Entity\InvoiceItem;
use App\Entity\Unit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PercentType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InvoiceItemFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
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
            ])
            ->add('price', MoneyType::class, [
                'currency' => 'CZK',
                'help' => 'Cena za kus',
            ])
            ->add('discount', PercentType::class, [
                'label' => 'Sleva',
                'help' => 'Vyjádřená v procentech',
            ])
            ->add('margin', PercentType::class, [
                'label' => 'Marže',
                'help' => 'Procentuální vyjádření marže',
            ])
            ->add('vat', PercentType::class, [
                'label' => 'DPH',
                'help' => 'Vyjádřená v procentech',
            ]);


    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => InvoiceItem::class,
        ]);
    }
}
