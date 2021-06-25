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
                'data' => InvoiceItem::UNIT_COUNT_DEFAUL_VALUE,
                'attr' => [
                    'min' => InvoiceItem::UNIT_COUNT_MIN_VALUE,
                    'max' => InvoiceItem::UNIT_COUNT_MAX_VALUE,
                    'step' => InvoiceItem::UNIT_COUNT_STEP,
                ],
                'html5' => true,
            ])
            ->add('price', MoneyType::class, [
                'currency' => 'CZK',
                'help' => 'Cena za kus',
                'required' => true,
                'divisor' => InvoiceItem::DIVISOR,
                'data' => InvoiceItem::PRICE_DEFAULT_VALUE,
            ])
            ->add('discount', PercentType::class, [
                'label' => 'Sleva',
                'help' => 'Vyjádřená v procentech',
                'type' => 'integer',
                'data' => InvoiceItem::DISCOUNT_DEFAUL_VALUE,
                'attr' => [
                    'min' => InvoiceItem::DISCOUNT_MIN_VALUE,
                    'max' => InvoiceItem::DISCOUNT_MAX_VALUE,
                    'step' => InvoiceItem::DISCOUNT_STEP_VALUE,
                ],
                'html5' => true,
            ])
            ->add('margin', PercentType::class, [
                'label' => 'Marže',
                'help' => 'Procentuální vyjádření marže',
                'type' => 'integer',
                'data' => InvoiceItem::MARGIN_DEFAUL_VALUE,
                'attr' => [
                    'min' => InvoiceItem::MARGIN_MIN_VALUE,
                    'max' => InvoiceItem::MARGIN_MAX_VALUE,
                    'step' => InvoiceItem::MARGIN_STEP_VALUE,
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
