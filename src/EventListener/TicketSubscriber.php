<?php

namespace App\EventListener;

use App\Entity\Ticket;
use App\Services\GeneralLogServices;
use DateTime;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class TicketSubscriber implements EventSubscriber
{
    private GeneralLogServices $generalLogServices;

    /**
     * @param GeneralLogServices $generalLogServices
     */
    public function __construct(GeneralLogServices $generalLogServices)
    {
        $this->generalLogServices = $generalLogServices;
    }

    /**
     * @inheritDoc
     */
    public function getSubscribedEvents(): array
    {
        return [
            Events::prePersist,
            Events::postPersist,
        ];
    }

    public function prePersist(LifecycleEventArgs $args): void
    {
        if ($args->getObject() instanceof Ticket) {
            $this->addAutoGenerateProperties($args->getObject());
        }
    }

    public function postPersist(LifecycleEventArgs $args): void
    {
        if ($args->getObject() instanceof Ticket) {
            $this->createLogWhenNewTicketCreated($args->getObject());
        }
    }

    /**
     * @param Object|Ticket $ticket
     */
    private function addAutoGenerateProperties(Ticket $ticket)
    {
        $creationTime = new DateTime();
        $deliveryTime = new DateTime();
        $reactionTime = new DateTime();

        $ticket->setCreatedDatetime($creationTime);
        $estimateDeliveryTime = $ticket->getServiceCatalog()->getEstimateTimeDelivery();
        $estimateReactionTime = $ticket->getServiceCatalog()->getEstimateTimeReaction();

        $ticket->setDeliveryDatetime($deliveryTime->modify("+ " . $estimateDeliveryTime . " seconds"));
        $ticket->setReactionDatetime($reactionTime->modify("+ " . $estimateReactionTime . " seconds"));
    }

    /**
     * @param Object|Ticket $ticket
     */
    private function createLogWhenNewTicketCreated(Ticket $ticket)
    {
        $this->generalLogServices->newLogTicket($ticket);
    }
}