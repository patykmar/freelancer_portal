<?php

namespace App\Dto\Out;

use DateTimeInterface;

class WorkInventoryDto
{
    public ?int $id;
    public string $description;
    public array $tariff;
    public DateTimeInterface $work_start;
    public ?DateTimeInterface $work_end;
    public array $user;
    public ?int $invoice;
    public array $company;
    public ?float $work_duration;
}