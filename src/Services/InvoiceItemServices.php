<?php


namespace App\Services;


class InvoiceItemServices
{
    /**
     * @param int $price
     * @param int $margin
     * @return int
     */
    public function calculateTotalMargin(int $price, int $margin): int
    {
        return round((float)(($price / 100) * $margin), 0);
    }

    /**
     * @param int $priceMargin price + margin
     * @param int $discount
     * @return int
     */
    public function calculateTotalDiscount(int $priceMargin, int $discount): int
    {
        return round((float)(($priceMargin / 100) * $discount), 0);
    }

    /**
     * @param int $price
     * @param float $unitCunt
     * @param int $margin - in percent eg. 50%
     * @param int $discount - in percent eg. 25%
     * @return int
     */
    public function calculateTotalPrice(int $price, float $unitCunt, int $margin = 0, int $discount = 0): int
    {
        $marginTotal = $this->calculateTotalMargin($price, $margin);
        $discountTotal = $this->calculateTotalDiscount(($price + $marginTotal), $discount);

        return round((float)((($price + $marginTotal) - $discountTotal) * $unitCunt), 0);
    }

    /**
     * @param int $priceTotal
     * @param int $vatMultiplier
     * @return int
     */
    public function calculateTotalPriceIncVat(int $priceTotal, int $vatMultiplier): int
    {
        return round((float)($priceTotal * ($vatMultiplier / 100)), 0);
    }
}