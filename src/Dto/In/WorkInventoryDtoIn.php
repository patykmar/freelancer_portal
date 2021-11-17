<?php

namespace App\Dto\In;

class WorkInventoryDtoIn
{
    public ?int $id;
    public string $description;
    public int $tariff;
    public int $work_start;
    public ?int $work_end = null;
    public int $user;
    public ?int $invoice = null;
    public int $company;
}