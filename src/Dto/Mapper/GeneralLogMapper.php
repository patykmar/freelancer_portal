<?php

namespace App\Dto\Mapper;

use App\Dto\GeneralLogDto;
use App\Entity\GeneralLog;
use App\Repository\CiRepository;
use App\Repository\TicketRepository;
use App\Repository\UserRepository;

class GeneralLogMapper implements MapperInterface
{
    private CiRepository $ciRepository;
    private UserRepository $userRepository;
    private TicketRepository $ticketRepository;

    /**
     * @param CiRepository $ciRepository
     * @param UserRepository $userRepository
     * @param TicketRepository $ticketRepository
     */
    public function __construct(CiRepository $ciRepository, UserRepository $userRepository, TicketRepository $ticketRepository)
    {
        $this->ciRepository = $ciRepository;
        $this->userRepository = $userRepository;
        $this->ticketRepository = $ticketRepository;
    }

    /**
     * @param GeneralLogDto|object $dto
     * @return GeneralLog
     */
    public function toEntity(object $dto): object
    {
        return $this->fullFillEntity(new GeneralLog(), $dto);
    }

    /**
     * @param GeneralLog|object $existingItem
     * @param GeneralLogDto|object $userData
     * @return GeneralLog|object
     */
    public function fullFillEntity(object $existingItem, object $userData): object
    {
        !is_null($userData->ci) && $existingItem->setCi($this->ciRepository->find($userData->ci));
        !is_null($userData->ticket) && $existingItem->setTicket($this->ticketRepository->find($userData->ticket));
        $existingItem->setUser($this->userRepository->find($userData->user));
        return $existingItem;
    }

    /**
     * @param GeneralLog|object $entity
     * @return GeneralLogDto|object
     */
    public function toDto(object $entity): object
    {
        $generalLogDto = new GeneralLogDto();
        $generalLogDto->id = $entity->getId();
        $generalLogDto->user = $entity->getUser()->getId();
        $generalLogDto->body = $entity->getBody();
        $generalLogDto->created = date_timestamp_get($entity->getCreated());

        !is_null($entity->getTicket()) && $generalLogDto->ticket = $entity->getTicket()->getId();
        !is_null($entity->getCi()) && $generalLogDto->ci = $entity->getCi()->getId();

        return $generalLogDto;
    }
}