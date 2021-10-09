<?php

namespace App\EventListener;

use App\Entity\Ticket;
use DateTime;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class TicketSubscriber implements EventSubscriber
{
    /**
     * @inheritDoc
     */
    public function getSubscribedEvents(): array
    {
        return [
            Events::prePersist,
        ];
    }

    public function prePersist(LifecycleEventArgs $args): void
    {
        if ($args->getObject() instanceof Ticket) {
            $this->addAutoGenerateProperties($args->getObject());
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
}