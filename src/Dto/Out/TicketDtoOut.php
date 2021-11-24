<?php

namespace App\Dto\Out;

class TicketDtoOut
{
    public ?int $id = 0;
    public array $serviceCatalog = array();
    public array $ci = array();
    public array $queue_user = array();
    public array $userCreated = array();
    public int $ticketState = 0;
    public int $ticketType = 0;
    public int $priority = 0;
    public int $impact = 0;
    public string $descriptionTitle = '';
    public string $descriptionBody = '';
    public int $createdDatetime = 0;
    public string $toString = '';
    public array $parentTicket = array();
    public ?int $userResolved = 0;
    public ?int $workInventory = 0;
    public ?int $ticketCloseState = 0;
    public ?string $closedNotes = '';
    public ?int $closedDatetime = 0;
    public ?int $reactionDatetime = 0;
    public ?int $deliveryDatetime = 0;
}