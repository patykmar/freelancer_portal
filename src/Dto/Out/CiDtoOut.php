<?php

namespace App\Dto\Out;

class CiDtoOut
{
    public int $id = 0;
    public array $parentCi;
    public array $childCis;
    public array $createdUser;
    public array $state;
    public array $tariff;
    public array $company;
    public string $name;
    public int $createdDateTime;
    public string $description;
    public array $queueTier1;
    public array $queueTier2;
    public array $queueTier3;
    public array $logs;
}