<?php

namespace App\Dto\In;

class TicketDtoIn
{
    public int $serviceCatalog;
    public int $ci;
    public int $queueUser;
    public int $userCreated;
    public ?int $userResolved = null;
    public ?int $parentTicket = null;
    public ?int $workInventory = null;
    public ?int $ticketCloseState = null;
    public int $ticketState;
    public int $ticketType;
    public int $priority;
    public int $impact;
    public string $descriptionTitle;
    public string $descriptionBody;
}