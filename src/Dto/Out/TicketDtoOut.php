<?php

namespace App\Dto\Out;

class TicketDtoOut
{
    public ?int $id = 0;
    public array $serviceCatalog = [];
    public array $ci = [];
    public array $queue_user = [];
    public array $userCreated = [];
    public int $ticketState = 0;
    public int $ticketType = 0;
    public int $priority = 0;
    public int $impact = 0;
    public string $descriptionTitle = '';
    public string $descriptionBody = '';
    public int $createdDatetime = 0;
    public string $toString = '';
    public array $parentTicket = [];
    public ?int $userResolved = 0;
    public ?int $workInventory = 0;
    public ?int $ticketCloseState = 0;
    public ?string $closedNotes = '';
    public ?int $closedDatetime = 0;
    public ?int $reactionDatetime = 0;
    public ?int $deliveryDatetime = 0;
    public array $logs = [] ;
    public array $childTickets = [] ;
}