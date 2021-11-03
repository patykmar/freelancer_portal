<?php

namespace App\Dto;

use DateTimeInterface;

class WorkInventoryDto
{
    public int $id;
    public string $name;
    public string $description;
    public string $company_id;
    public string $vat_number;
    public DateTimeInterface $created;
    public DateTimeInterface $modify;
    public string $street;
    public string $city;
    public string $zip_code;
    public int $country;
    public string $countryName;
    public string $account_number;
    public string $iban;
    public bool $isSupplier;
}