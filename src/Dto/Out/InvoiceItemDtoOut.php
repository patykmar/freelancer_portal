<?php

namespace App\Dto\Out;

class InvoiceItemDtoOut
{
    public int $id;
    public int $invoice;
    public array $vat;
    public string $name;
    public int $price;
    public int $margin;
    public int $margin_total;
    public int $price_inc_margin;
    public int $discount;
    public int $discount_total;
    public int $price_inc_margin_minus_discount;
    public int $price_inc_margin_discount_multi_vat;
    public int $price_inc_margin_multi_vat;
    public float $unit_count;
    public int $total_price_inc_margin_discount_vat;
    public int $total_price_inc_margin_vat;
}