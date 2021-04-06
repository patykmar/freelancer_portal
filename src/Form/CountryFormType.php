<?php

namespace App\Form;

use App\Entity\Country;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CountryFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class,array(
                'attr' => array(
                    'class' => 'form-control',
                    'maxlength' => 255,
                    'placeholder' => 'Please put there name of country'
                ),
                'label' => "Country name"
            ));
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event){
            /** @var Country */
            $country = $event->getData();
            $form = $event->getForm();

            // check if exist ID, if so you are editing otherwise you are adding new item
            if ($country->getId() === null)
                $label = "Add new country";
            else
                $label = "Save";

            $form->add('save', SubmitType::class, array(
                'attr' => array(
                    'class' => 'btn btn-success float-right mt-3',
                ),
                'label' => $label
            ));
        });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Country::class,
        ]);
    }
}
