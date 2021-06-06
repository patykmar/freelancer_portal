<?php


namespace App\EventSubscriber;


use App\Entity\Invoice;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Security;

class InvoiceSubscriber implements EventSubscriberInterface
{
    /**
     * @var Security
     */
    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            BeforeEntityPersistedEvent::class => ['addMissingValues'],
        ];
    }

    /**
     * @param BeforeEntityPersistedEvent $event
     */
    public function addMissingValues(BeforeEntityPersistedEvent $event): void
    {
        $entity = $event->getEntityInstance();

        // for invoice instance only
        if ($entity instanceof Invoice) {
            // set user ID to invoice
            $entity->setUserCreated($this->security->getUser());
        }

        unset($entity);
    }


}