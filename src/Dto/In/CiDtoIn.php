<?php

namespace App\Dto\In;

class CiDtoIn
{
    public ?int $id;
    public ?int $parentCi = null;
    public int $createdUser;
    public int $state;
    public int $tariff;
    public int $company;
    public string $name;
    public string $description;
    public int $queueTier1;
    public ?int $queueTier2 = null;
    public ?int $queueTier3 = null;
}