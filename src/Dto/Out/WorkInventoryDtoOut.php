<?php

namespace App\Dto\Out;

class WorkInventoryDtoOut
{
    public ?int $id;
    public string $description;
    public array $tariff;
    public int $workStart;
    public ?int $workEnd;
    public array $user;
    public ?int $invoice;
    public array $company;
    public ?float $work_duration;
}