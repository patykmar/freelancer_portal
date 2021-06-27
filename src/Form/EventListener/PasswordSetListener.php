<?php


namespace App\Form\EventListener;

use App\Repository\UserRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class PasswordSetListener implements EventSubscriberInterface
{

    private UserRepository $userRepository;
    private UserPasswordEncoderInterface $encoder;

    /**
     * PasswordSetListener constructor. Injected services from FormType class
     * @link https://symfony.com/doc/current/form/dynamic_form_modification.html#creating-the-form-type
     * @param UserRepository $userRepository
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(UserRepository $userRepository, UserPasswordEncoderInterface $encoder)
    {
        $this->userRepository = $userRepository;
        $this->encoder = $encoder;
    }


    /**
     * @inheritDoc
     * @link https://symfony.com/doc/current/form/events.html#event-subscribers
     */
    public static function getSubscribedEvents(): iterable
    {
        return [
            FormEvents::PRE_SUBMIT => 'onPreSubmit'
        ];
    }

    /**
     * @param FormEvent $event
     */
    public function onPreSubmit(FormEvent $event): void
    {
        $formUserData = $event->getData();
        $form = $event->getForm();

        if (!$formUserData) {
            return;
        }

        if ($formUserData['new-password'] !== $formUserData['re-type-new-password']) {
            $form->addError(new FormError('New password and re-type password is not the same!'));
        }

        $userFromDb = $this->userRepository->find($formUserData['user-id']);

        if (!($this->encoder->isPasswordValid($userFromDb, $formUserData['old-password']))) {
            $form->addError(new FormError('The old password is not valid!'));
        }

    }
}