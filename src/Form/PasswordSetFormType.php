<?php


namespace App\Form;

use App\Form\EventListener\PasswordSetListener;
use App\Repository\UserRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class PasswordSetFormType extends AbstractType
{

    private UserRepository $userRepository;
    private UserPasswordEncoderInterface $encoder;

    /**
     * PasswordSetFormType constructor.
     * @param UserRepository $userRepository
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(UserRepository $userRepository, UserPasswordEncoderInterface $encoder)
    {
        $this->userRepository = $userRepository;
        $this->encoder = $encoder;
    }


    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user-id', HiddenType::class)
            ->add('old-password', PasswordType::class)
            ->add('new-password', PasswordType::class)
            ->add('re-type-new-password', PasswordType::class)
            ->add('save', SubmitType::class)
            ->addEventSubscriber(new PasswordSetListener(
                $this->userRepository,
                $this->encoder
            ));
    }

}