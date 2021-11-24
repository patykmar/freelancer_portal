<?php

namespace App\Dto\Mapper;

use App\Dto\Out\TicketDtoOut;
use App\Entity\Ticket;

class TicketMapper implements MapperInterface
{

    /**
     * @inheritDoc
     */
    public function toEntity(object $dto): object
    {
        return $this->fullFillEntity(new Ticket(), $dto);
    }

    /**
     * @inheritDoc
     */
    public function fullFillEntity(object $existingItem, object $userData): object
    {
        // TODO: Implement fullFillEntity() method.
        return $existingItem;
    }

    /**
     * @param Ticket|object $entity
     * @return TicketDtoOut;
     */
    public function toDto(object $entity): object
    {
        $ticketDtoOut = new TicketDtoOut();
        $ticketDtoOut->id = $entity->getId();
        $ticketDtoOut->serviceCatalog['id'] = $entity->getServiceCatalog()->getId();
        $ticketDtoOut->serviceCatalog['name'] = $entity->getServiceCatalog()->getName();
        $ticketDtoOut->ci['id'] = $entity->getCi()->getId();
        $ticketDtoOut->ci['name'] = $entity->getCi()->getName();
        $ticketDtoOut->queue_user['id'] = $entity->getQueueUser()->getId();
        $ticketDtoOut->queue_user['user'] = $entity->getQueueUser()->getUser()->__toString();
        $ticketDtoOut->queue_user['queue'] = $entity->getQueueUser()->getQueue()->getName();
        $ticketDtoOut->userCreated['id'] = $entity->getUserCreated()->getId();
        $ticketDtoOut->userCreated['name'] = $entity->getUserCreated()->__toString();
        $ticketDtoOut->ticketState = $entity->getTicketState()->getId();
        $ticketDtoOut->ticketType = $entity->getTicketType()->getId();
        $ticketDtoOut->priority = $entity->getPriority()->getId();
        $ticketDtoOut->impact = $entity->getImpact()->getId();
        $ticketDtoOut->descriptionTitle = $entity->getDescriptionTitle();
        $ticketDtoOut->descriptionBody = $entity->getDescriptionBody();
        $ticketDtoOut->createdDatetime = date_timestamp_get($entity->getCreatedDatetime());
        $ticketDtoOut->toString =
            $entity->getTicketType()->getAbbreviation().$entity->getId() . ';' .
            $entity->getCi()->getName() . ';'.
            $entity->getQueueUser()->getUser()->__toString().';'.
            $entity->getServiceCatalog()->getName();

        if (!is_null($entity->getParentTicket())) {
            $ticketDtoOut->parentTicket['id'] = $entity->getParentTicket()->getId();
            $ticketDtoOut->parentTicket['ticket-id'] = $entity->getParentTicket()->getTicketType()->getAbbreviation() . $entity->getParentTicket()->getId();
        }
        !is_null($entity->getUserResolved()) && $ticketDtoOut->userResolved = $entity->getUserResolved()->getId();
        !$entity->getWorkInventory() !== null && $ticketDtoOut->workInventory = $entity->getWorkInventory()->getId();
        !is_null($entity->getTicketCloseState()) && $ticketDtoOut->ticketCloseState = $entity->getTicketCloseState()->getId();
        !is_null($entity->getClosedNotes()) && $ticketDtoOut->closedNotes = $entity->getClosedNotes();
        !is_null($entity->getClosedDatetime()) && $ticketDtoOut->closedDatetime = date_timestamp_get($entity->getClosedDatetime());
        !is_null($entity->getReactionDatetime()) && $ticketDtoOut->reactionDatetime = date_timestamp_get($entity->getReactionDatetime());
        !is_null($entity->getDeliveryDatetime()) && $ticketDtoOut->deliveryDatetime = date_timestamp_get($entity->getDeliveryDatetime());

        return $ticketDtoOut;
    }
}