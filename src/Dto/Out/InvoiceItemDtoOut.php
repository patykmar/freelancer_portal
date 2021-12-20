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
    public int $marginTotal;
    public int $priceIncMargin;
    public int $discount;
    public int $discountTotal;
    public int $priceIncMarginMinusDiscount;
    public int $priceIncMarginDiscountMultiVat;
    public int $priceIncMarginMultiVat;
    public float $unitCount;
    public int $totalPriceIncMarginDiscountVat;
    public int $totalPriceIncMarginVat;
}