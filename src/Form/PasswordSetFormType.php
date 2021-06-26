<?php


namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;


class PasswordSetFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('old-password', PasswordType::class)
            ->add('new-password', PasswordType::class)
            ->add('re-type-new-password', PasswordType::class)
            ->add('save', SubmitType::class);
    }

}