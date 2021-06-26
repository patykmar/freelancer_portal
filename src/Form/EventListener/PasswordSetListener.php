<?php


namespace App\Form\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;


class PasswordSetListener implements EventSubscriberInterface
{

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

    public function onPreSubmit(FormEvent $event): void
    {
        $formUserData = $event->getData();
        $form = $event->getForm();

        if (!$formUserData) {
            return;
        }

        if ($formUserData['new-password'] !== $formUserData['re-type-new-password']){
            $form->addError(new FormError('New password and re-type password is not the same!'));
        }
    }
}