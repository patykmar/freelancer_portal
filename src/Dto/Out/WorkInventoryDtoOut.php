<?php

namespace App\Dto\Out;

use DateTimeInterface;

class WorkInventoryDtoOut
{
    public ?int $id;
    public string $description;
    public array $tariff;
    public int $work_start;
    public ?int $work_end;
    public array $user;
    public ?int $invoice;
    public array $company;
    public ?float $work_duration;
}