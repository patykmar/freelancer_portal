<?php

namespace App\Dto\Mapper;

use App\Dto\In\TicketDtoIn;
use App\Dto\Out\TicketDtoOut;
use App\Entity\Ticket;
use App\Repository\CiRepository;
use App\Repository\GeneralStateRepository;
use App\Repository\InfluencingTicketRepository;
use App\Repository\QueueUserRepository;
use App\Repository\ServiceCatalogRepository;
use App\Repository\TicketRepository;
use App\Repository\TicketTypeRepository;
use App\Repository\UserRepository;
use App\Repository\WorkInventoryRepository;

class TicketMapper implements MapperInterface
{
    private ServiceCatalogRepository $serviceCatalogRepository;
    private CiRepository $ciRepository;
    private QueueUserRepository $queueUserRepository;
    private UserRepository $userRepository;
    private TicketRepository $ticketRepository;
    private WorkInventoryRepository $workInventoryRepository;
    private GeneralStateRepository $generalStateRepository;
    private TicketTypeRepository $ticketTypeRepository;
    private InfluencingTicketRepository $influencingTicketRepository;
    private GeneralLogMapper $generalLogMapper;

    /**
     * @param ServiceCatalogRepository $serviceCatalogRepository
     * @param CiRepository $ciRepository
     * @param QueueUserRepository $queueUserRepository
     * @param UserRepository $userRepository
     * @param TicketRepository $ticketRepository
     * @param WorkInventoryRepository $workInventoryRepository
     * @param GeneralStateRepository $generalStateRepository
     * @param TicketTypeRepository $ticketTypeRepository
     * @param InfluencingTicketRepository $influencingTicketRepository
     * @param GeneralLogMapper $generalLogMapper
     */

    public function __construct(
        ServiceCatalogRepository    $serviceCatalogRepository,
        CiRepository                $ciRepository,
        QueueUserRepository         $queueUserRepository,
        UserRepository              $userRepository,
        TicketRepository            $ticketRepository,
        WorkInventoryRepository     $workInventoryRepository,
        GeneralStateRepository      $generalStateRepository,
        TicketTypeRepository        $ticketTypeRepository,
        InfluencingTicketRepository $influencingTicketRepository,
        GeneralLogMapper $generalLogMapper
    )
    {
        $this->serviceCatalogRepository = $serviceCatalogRepository;
        $this->ciRepository = $ciRepository;
        $this->queueUserRepository = $queueUserRepository;
        $this->userRepository = $userRepository;
        $this->ticketRepository = $ticketRepository;
        $this->workInventoryRepository = $workInventoryRepository;
        $this->generalStateRepository = $generalStateRepository;
        $this->ticketTypeRepository = $ticketTypeRepository;
        $this->influencingTicketRepository = $influencingTicketRepository;
        $this->generalLogMapper = $generalLogMapper;
    }

    /**
     * @param TicketDtoIn|object $dto
     * @return Ticket|object
     */
    public function toEntity(object $dto): object
    {
        return $this->fullFillEntity(new Ticket(), $dto);
    }

    /**
     * @param Ticket|object $existingItem
     * @param TicketDtoIn|object $userData
     * @return Ticket|object
     */
    public function fullFillEntity(object $existingItem, object $userData): object
    {
        $existingItem->setServiceCatalog($this->serviceCatalogRepository->find($userData->serviceCatalog));
        $existingItem->setCi($this->ciRepository->find($userData->ci));
        $existingItem->setQueueUser($this->queueUserRepository->find($userData->queueUser));
        $existingItem->setUserCreated($this->userRepository->find($userData->userCreated));
        $existingItem->setTicketState($this->generalStateRepository->find($userData->ticketState));
        $existingItem->setTicketType($this->ticketTypeRepository->find($userData->ticketType));
        $existingItem->setPriority($this->influencingTicketRepository->find($userData->priority));
        $existingItem->setImpact($this->influencingTicketRepository->find($userData->impact));
        $existingItem->setDescriptionTitle($userData->descriptionTitle);
        $existingItem->setDescriptionBody($userData->descriptionBody);

        !is_null($userData->ticketCloseState) && $existingItem->setTicketCloseState($this->generalStateRepository->find($userData->ticketCloseState));
        !is_null($userData->workInventory) && $existingItem->setWorkInventory($this->workInventoryRepository->find($userData->workInventory));
        !is_null($userData->userResolved) && $existingItem->setUserResolved($this->userRepository->find($userData->userResolved));
        !is_null($userData->parentTicket) && $existingItem->setParentTicket($this->ticketRepository->find($userData->parentTicket));

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
        $ticketDtoOut->queueUser['id'] = $entity->getQueueUser()->getId();
        $ticketDtoOut->queueUser['user'] = $entity->getQueueUser()->getUser()->__toString();
        $ticketDtoOut->queueUser['queue'] = $entity->getQueueUser()->getQueue()->getName();
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
        !is_null($entity->getWorkInventory()) && $ticketDtoOut->workInventory = $entity->getWorkInventory()->getId();
        !is_null($entity->getTicketCloseState()) && $ticketDtoOut->ticketCloseState = $entity->getTicketCloseState()->getId();
        !is_null($entity->getClosedNotes()) && $ticketDtoOut->closedNotes = $entity->getClosedNotes();
        !is_null($entity->getClosedDatetime()) && $ticketDtoOut->closedDatetime = date_timestamp_get($entity->getClosedDatetime());
        !is_null($entity->getReactionDatetime()) && $ticketDtoOut->reactionDatetime = date_timestamp_get($entity->getReactionDatetime());
        !is_null($entity->getDeliveryDatetime()) && $ticketDtoOut->deliveryDatetime = date_timestamp_get($entity->getDeliveryDatetime());

        return $ticketDtoOut;
    }

    /**
     * @param Ticket|object $entity
     * @return TicketDtoOut;
     */
    public function toDtoItem(object $entity)
    {
        $ticketDtoOut = $this->toDto($entity);
        foreach ($entity->getLogs() as $logItem){
            $ticketDtoOut->logs[] = $this->generalLogMapper->toDto($logItem);
        }
        foreach ($entity->getChildTickets() as $childTicket){
            $ticketDtoOut->childTickets[] = $this->toDto($childTicket);
        }
        return $ticketDtoOut;
    }
}