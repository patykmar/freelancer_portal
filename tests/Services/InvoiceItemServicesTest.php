<?php

namespace App\Tests\Services;

use App\Services\InvoiceItemServices;
use PHPUnit\Framework\TestCase;


class InvoiceItemServicesTest extends TestCase
{
    private const TOTAL_PRICE_ENTERED_PRICE = 123456789;

    public function testCalculateMarginTotal()
    {
        $invoiceItemServices = new InvoiceItemServices();
        $this->assertEquals(0, $invoiceItemServices->calculateMarginTotal(123456700, 0));
        $this->assertEquals(1234567, $invoiceItemServices->calculateMarginTotal(123456700, 1));
        $this->assertEquals(18518505, $invoiceItemServices->calculateMarginTotal(123456700, 15));
        $this->assertEquals(53086419, $invoiceItemServices->calculateMarginTotal(123456789, 43));
        $this->assertEquals(55555555, $invoiceItemServices->calculateMarginTotal(123456789, 45));
        $this->assertEquals(61728350, $invoiceItemServices->calculateMarginTotal(123456700, 50));
        $this->assertEquals(77777777, $invoiceItemServices->calculateMarginTotal(123456789, 63));
        $this->assertEquals(82716049, $invoiceItemServices->calculateMarginTotal(123456789, 67));
        $this->assertEquals(122222133, $invoiceItemServices->calculateMarginTotal(123456700, 99));
        $this->assertEquals(123456700, $invoiceItemServices->calculateMarginTotal(123456700, 100));
    }

    public function testCalculatePriceIncMargin()
    {
        $invoiceItemServices = new InvoiceItemServices();
        $this->assertEquals(1200000, $invoiceItemServices->calculatePriceIncMargin(1000000, 200000));
        $this->assertEquals(188384, $invoiceItemServices->calculatePriceIncMargin(156987, 31397));
        $this->assertEquals(190377985, $invoiceItemServices->calculatePriceIncMargin(158648321, 31729664));
        $this->assertEquals(177420, $invoiceItemServices->calculatePriceIncMargin(147850, 29570));
        $this->assertEquals(258741, $invoiceItemServices->calculatePriceIncMargin(258741, 0));
        $this->assertEquals(5126428, $invoiceItemServices->calculatePriceIncMargin(2563214, 2563214));
        $this->assertEquals(247397042, $invoiceItemServices->calculatePriceIncMargin(123698521, 123698521));
    }

    public function testCalculateTotalDiscount()
    {
        $invoiceItemServices = new InvoiceItemServices();
        $this->assertEquals(0, $invoiceItemServices->calculateDiscountTotal(135802370, 0));
        $this->assertEquals(1246913, $invoiceItemServices->calculateDiscountTotal(124691267, 1));
        $this->assertEquals(19037799, $invoiceItemServices->calculateDiscountTotal(190377985, 10));
        $this->assertEquals(8055158, $invoiceItemServices->calculateDiscountTotal(32220630, 25));
        $this->assertEquals(750000, $invoiceItemServices->calculateDiscountTotal(1500000, 50));
        $this->assertEquals(154777665, $invoiceItemServices->calculateDiscountTotal(245678833, 63));
        $this->assertEquals(184259125, $invoiceItemServices->calculateDiscountTotal(245678833, 75));
        $this->assertEquals(159678, $invoiceItemServices->calculateDiscountTotal(177420, 90));
        $this->assertEquals(243222045, $invoiceItemServices->calculateDiscountTotal(245678833, 99));
        $this->assertEquals(246913400, $invoiceItemServices->calculateDiscountTotal(246913400, 100));
    }

    public function testCalculatePriceIncMarginMinusDiscount()
    {
        $invoiceItemServices = new InvoiceItemServices();
        $this->assertEquals(171340186, $invoiceItemServices->calculatePriceIncMarginMinusDiscount(190377985, 19037799));
        $this->assertEquals(17742, $invoiceItemServices->calculatePriceIncMarginMinusDiscount(177420, 159678));

    }


    public function testCalculatePriceIncMarginDiscountMultiVat()
    {
        $invoiceItemServices = new InvoiceItemServices();
        $this->assertEquals(313077,$invoiceItemServices->calculatePriceIncMarginDiscountMultiVat(258741,121));
        $this->assertEquals(6202978,$invoiceItemServices->calculatePriceIncMarginDiscountMultiVat(5126428,121));
    }

    public function testCalculatePriceIncMarginMultiVat()
    {
        $invoiceItemServices = new InvoiceItemServices();
        $this->assertEquals(313077,$invoiceItemServices->calculatePriceIncMarginMultiVat(258741,121));
        $this->assertEquals(6202978,$invoiceItemServices->calculatePriceIncMarginMultiVat(5126428,121));
    }

    public function testCalculateTotalPriceIncMarginDiscountVat()
    {
        $invoiceItemServices = new InvoiceItemServices();
        $this->assertEquals(1234568,
            $invoiceItemServices->calculateTotalPriceIncMarginDiscountVat(
                self::TOTAL_PRICE_ENTERED_PRICE,
                0.01)
        );
        $this->assertEquals(3703704,
            $invoiceItemServices->calculateTotalPriceIncMarginDiscountVat(
                self::TOTAL_PRICE_ENTERED_PRICE,
                0.03)
        );
        $this->assertEquals(13580247,
            $invoiceItemServices->calculateTotalPriceIncMarginDiscountVat(
                self::TOTAL_PRICE_ENTERED_PRICE,
                0.11)
        );
        $this->assertEquals(30864197,
            $invoiceItemServices->calculateTotalPriceIncMarginDiscountVat(
                self::TOTAL_PRICE_ENTERED_PRICE,
                0.25)
        );
        $this->assertEquals(41975308,
            $invoiceItemServices->calculateTotalPriceIncMarginDiscountVat(
                self::TOTAL_PRICE_ENTERED_PRICE,
                0.34)
        );
        $this->assertEquals(56790123,
            $invoiceItemServices->calculateTotalPriceIncMarginDiscountVat(
                self::TOTAL_PRICE_ENTERED_PRICE,
                0.46)
        );
        $this->assertEquals(206172838,
            $invoiceItemServices->calculateTotalPriceIncMarginDiscountVat(
                self::TOTAL_PRICE_ENTERED_PRICE,
                1.67)
        );
        $this->assertEquals(348148145,
            $invoiceItemServices->calculateTotalPriceIncMarginDiscountVat(
                self::TOTAL_PRICE_ENTERED_PRICE,
                2.82)
        );
        $this->assertEquals(491358020,
            $invoiceItemServices->calculateTotalPriceIncMarginDiscountVat(
                self::TOTAL_PRICE_ENTERED_PRICE,
                3.98)
        );
        $this->assertEquals(616049377,
            $invoiceItemServices->calculateTotalPriceIncMarginDiscountVat(
                self::TOTAL_PRICE_ENTERED_PRICE,
                4.99)
        );
        $this->assertEquals(12345678900,
            $invoiceItemServices->calculateTotalPriceIncMarginDiscountVat(
                self::TOTAL_PRICE_ENTERED_PRICE,
                100)
        );
        $this->assertEquals(12345678776543212,
            $invoiceItemServices->calculateTotalPriceIncMarginDiscountVat(
                self::TOTAL_PRICE_ENTERED_PRICE,
                99999999)
        );
    }
    public function testCalculateTotalPriceIncMarginVat()
    {
        $invoiceItemServices = new InvoiceItemServices();
        $this->assertEquals(1234568,
            $invoiceItemServices->calculateTotalPriceIncMarginVat(
                self::TOTAL_PRICE_ENTERED_PRICE,
                0.01)
        );
        $this->assertEquals(3703704,
            $invoiceItemServices->calculateTotalPriceIncMarginVat(
                self::TOTAL_PRICE_ENTERED_PRICE,
                0.03)
        );
        $this->assertEquals(13580247,
            $invoiceItemServices->calculateTotalPriceIncMarginVat(
                self::TOTAL_PRICE_ENTERED_PRICE,
                0.11)
        );
        $this->assertEquals(30864197,
            $invoiceItemServices->calculateTotalPriceIncMarginVat(
                self::TOTAL_PRICE_ENTERED_PRICE,
                0.25)
        );
        $this->assertEquals(41975308,
            $invoiceItemServices->calculateTotalPriceIncMarginVat(
                self::TOTAL_PRICE_ENTERED_PRICE,
                0.34)
        );
        $this->assertEquals(56790123,
            $invoiceItemServices->calculateTotalPriceIncMarginVat(
                self::TOTAL_PRICE_ENTERED_PRICE,
                0.46)
        );
        $this->assertEquals(206172838,
            $invoiceItemServices->calculateTotalPriceIncMarginVat(
                self::TOTAL_PRICE_ENTERED_PRICE,
                1.67)
        );
        $this->assertEquals(348148145,
            $invoiceItemServices->calculateTotalPriceIncMarginVat(
                self::TOTAL_PRICE_ENTERED_PRICE,
                2.82)
        );
        $this->assertEquals(491358020,
            $invoiceItemServices->calculateTotalPriceIncMarginVat(
                self::TOTAL_PRICE_ENTERED_PRICE,
                3.98)
        );
        $this->assertEquals(616049377,
            $invoiceItemServices->calculateTotalPriceIncMarginVat(
                self::TOTAL_PRICE_ENTERED_PRICE,
                4.99)
        );
        $this->assertEquals(12345678900,
            $invoiceItemServices->calculateTotalPriceIncMarginVat(
                self::TOTAL_PRICE_ENTERED_PRICE,
                100)
        );
        $this->assertEquals(12345678776543212,
            $invoiceItemServices->calculateTotalPriceIncMarginVat(
                self::TOTAL_PRICE_ENTERED_PRICE,
                99999999)
        );
    }
}
