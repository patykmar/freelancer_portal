<?php

namespace App\Dto;

class TariffDto
{
    public int $id;
    public string $name;
    public int $price;
    public array $vat;
}