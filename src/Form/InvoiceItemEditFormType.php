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

class InvoiceItemEditFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => array(
                    'class' => 'form-control',
                    'maxlength' => 255
                ),
                'label' => 'Item name: ',
            ])
            ->add('unit_count', NumberType::class, [
                'label' => 'Unit count:',
                'attr' => [
                    'min' => InvoiceItem::UNIT_COUNT_MIN_VALUE,
                    'max' => InvoiceItem::UNIT_COUNT_MAX_VALUE,
                ],
            ])
            ->add('price', MoneyType::class, [
                'currency' => 'CZK',
                'help' => 'Price per unit',
                'required' => true,
                'divisor' => InvoiceItem::DIVISOR,
            ])
            ->add('discount', PercentType::class, [
                'label' => 'Discount:',
                'help' => 'in percent, allowed range '.InvoiceItem::DISCOUNT_MIN_VALUE.'% - '.InvoiceItem::DISCOUNT_MAX_VALUE.'%',
                'type' => 'integer',
                'attr' => [
                    'min' => InvoiceItem::DISCOUNT_MIN_VALUE,
                    'max' => InvoiceItem::DISCOUNT_MAX_VALUE,
                ],
                'html5' => true,
            ])
            ->add('margin', PercentType::class, [
                'label' => 'Margin:',
                'help' => 'in percent, allowed range '.InvoiceItem::MARGIN_MIN_VALUE.'% - '.InvoiceItem::MARGIN_MAX_VALUE.'%',
                'type' => 'integer',
                'attr' => [
                    'min' => InvoiceItem::MARGIN_MIN_VALUE,
                    'max' => InvoiceItem::MARGIN_MAX_VALUE,
                ],
                'html5' => true,
            ])
            ->add('vat', EntityType::class, [
                'label' => 'VAT',
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