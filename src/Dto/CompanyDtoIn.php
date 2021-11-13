<?php

namespace App\Dto;

class CompanyDtoIn
{
    public int $id;
    public string $name;
    public string $description;
    public string $companyId;
    public ?string $vatNumber = null;
    public ?string $street = null;
    public ?string $city = null;
    public ?string $zipCode = null;
    public int $country;
    public ?string $accountNumber = null;
    public ?string $iban = null;
    public ?bool $isSupplier = false;
}