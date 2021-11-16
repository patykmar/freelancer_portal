<?php

namespace App\Dto\In;

use DateTimeInterface;

class WorkInventoryDtoIn
{
    public ?int $id;
    public string $description;
    public int $tariff;
    public DateTimeInterface $work_start;
    public ?DateTimeInterface $work_end;
    public int $user;
    public ?int $invoice;
    public int $company;
}