<?php

namespace App\Dto\Out;

use DateTimeInterface;

class CompanyDtoOut
{
    public int $id;
    public string $name;
    public string $description;
    public string $companyId;
    public ?string $vatNumber;
    public DateTimeInterface $created;
    public ?DateTimeInterface $modify;
    public ?string $street;
    public ?string $city;
    public ?string $zipCode;
    public array $country;
    public ?string $accountNumber;
    public ?string $iban;
    public ?bool $isSupplier;
}