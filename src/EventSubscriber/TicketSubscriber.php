<?php

namespace App\EventSubscriber;

use App\Entity\GeneralState;
use App\Entity\Ticket;
use App\Repository\GeneralStateRepository;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Security;

class TicketSubscriber implements EventSubscriberInterface
{
    private Security $security;
    private GeneralStateRepository $generalStateRepository;

    public function __construct(Security $security, GeneralStateRepository $generalStateRepository)
    {
        $this->security = $security;
        $this->generalStateRepository = $generalStateRepository;
    }

    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents(): array
    {
        return [
            BeforeEntityPersistedEvent::class => ['addMissingValues'],
        ];
    }

    public function addMissingValues(BeforeEntityPersistedEvent $event): void
    {
        $entity = $event->getEntityInstance();
        if ($entity instanceof Ticket) {
            $stateOpen = $this->generalStateRepository->findOneBy([
                'isForTicket' => true,
                'name' => 'Open',
            ]);

            $entity->setUserCreated($this->security->getUser());
            $entity->setTicketState($stateOpen);
        }
    }
}