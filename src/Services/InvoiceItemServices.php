<?php


namespace App\Services;


class InvoiceItemServices
{
    /**
     * @param int $price
     * @param int $margin
     * @return int
     */
    public function calculateMarginTotal(int $price, int $margin): int
    {
        return round((float)(($price / 100) * $margin), 0);
    }

    /**
     * @param int $price
     * @param int $margin
     * @return int
     */
    public function calculatePriceIncMargin(int $price, int $margin): int
    {
        return $price + $margin;
    }

    /**
     * @param int $priceMargin price + margin
     * @param int $discount
     * @return int
     */
    public function calculateDiscountTotal(int $priceIncMargin, int $discount): int
    {
        return round((float)(($priceIncMargin / 100) * $discount), 0);
    }

    /**
     * @param int $priceIncMargin
     * @param int $discountTotal
     * @return int
     */
    public function calculatePriceIncMarginMinusDiscount(int $priceIncMargin, int $discountTotal): int
    {
        return $priceIncMargin - $discountTotal;
    }

    /**
     * @param int $priceIncMarginDiscount
     * @param int $vatMultiplier
     * @return int
     */
    public function calculatePriceIncMarginDiscountMultiVat(int $priceIncMarginDiscount, int $vatMultiplier): int
    {
        return round((float)(($vatMultiplier / 100) * $priceIncMarginDiscount), 0);
    }

    /**
     * @param int $priceIncMargin
     * @param int $vatMultiplier
     * @return int
     */
    public function calculatePriceIncMarginMultiVat(int $priceIncMargin, int $vatMultiplier): int
    {
        return round((float)(($vatMultiplier / 100) * $priceIncMargin), 0);
    }

    /**
     * @param int $priceIncDiscountMultiVat
     * @param float $unitCount
     * @return int
     */
    public function calculateTotalPriceIncMarginDiscountVat(int $priceIncDiscountMultiVat, float $unitCount): int
    {
        return round((float)($priceIncDiscountMultiVat * $unitCount), 0);
    }

    /**
     * @param int $priceMultiVat
     * @param float $unitCount
     * @return int
     */
    public function calculateTotalPriceIncMarginVat(int $priceMultiVat, float $unitCount): int
    {
        return round((float)($priceMultiVat * $unitCount), 0);
    }

}