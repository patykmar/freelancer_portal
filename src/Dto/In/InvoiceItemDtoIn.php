<?php

namespace App\Dto\In;

class InvoiceItemDtoIn
{
    public ?int $id;
    public ?int $invoice = null;
    public int $vat;
    public string $name;
    public int $price;
    public int $margin = 0;
    public int $discount = 0;
    public float $unitCount;
}