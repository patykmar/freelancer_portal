<?php

namespace App\Dto\Out;

class TicketDtoOut
{
    public ?int $id;
    public array $serviceCatalog;
    public array $ci;
    public array $queue_user;
    public array $userCreated;
    public array $userResolved;
    public ?int $parentTicket;
    public ?int $workInventory;
    public ?int $ticketCloseState;
    public int $ticketState;
    public int $ticketType;
    public int $priority;
    public int $impact;
    public string $descriptionTitle;
    public string $descriptionBody;
    public ?string $closedNotes;
    public ?int $closedDatetime;
    public ?int $reactionDatetime;
    public ?int $deliveryDatetime;
    public int $createdDatetime;
    public string $toString;
}