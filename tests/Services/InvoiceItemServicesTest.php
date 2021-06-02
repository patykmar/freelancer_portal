<?php

namespace App\Tests\Services;

use App\Services\InvoiceItemServices;
use PHPUnit\Framework\TestCase;


class InvoiceItemServicesTest extends TestCase
{
    private const TOTAL_PRICE_ENTERED_PRICE = 123456700;

    public function testCalculateTotalDiscount()
    {
        $invoiceItemServices = new InvoiceItemServices();
        $this->assertEquals(0,$invoiceItemServices->calculateTotalDiscount(135802370,0));
        $this->assertEquals(1246913,$invoiceItemServices->calculateTotalDiscount(124691267, 1));
        $this->assertEquals(8055158, $invoiceItemServices->calculateTotalDiscount(32220630, 25));
        $this->assertEquals(750000, $invoiceItemServices->calculateTotalDiscount(1500000, 50));
        $this->assertEquals(184259125, $invoiceItemServices->calculateTotalDiscount(245678833, 75));
        $this->assertEquals(184259125, $invoiceItemServices->calculateTotalDiscount(245678833, 75));
        $this->assertEquals(243222045, $invoiceItemServices->calculateTotalDiscount(245678833, 99));
        $this->assertEquals(246913400, $invoiceItemServices->calculateTotalDiscount(246913400, 100));
    }

    public function testCalculateTotalMargin()
    {
        $invoiceItemServices = new InvoiceItemServices();
        $this->assertEquals(0,$invoiceItemServices->calculateTotalMargin(123456700,0));
        $this->assertEquals(1234567,$invoiceItemServices->calculateTotalMargin(123456700,1));
        $this->assertEquals(61728350,$invoiceItemServices->calculateTotalMargin(123456700,50));
        $this->assertEquals(122222133,$invoiceItemServices->calculateTotalMargin(123456700,99));
        $this->assertEquals(123456700,$invoiceItemServices->calculateTotalMargin(123456700,100));
    }

    public function testCalculateTotalPriceNoMarginAndDiscount()
    {
        $invoiceItemServices = new InvoiceItemServices();

        // margin = discount = 0%, unit = 0.25x
        $this->assertEquals(30864175,
            $invoiceItemServices->calculateTotalPrice(self::TOTAL_PRICE_ENTERED_PRICE, 0.25)
        );
        // margin = discount = 0%, unit = 0.5x
        $this->assertEquals(61728350,
            $invoiceItemServices->calculateTotalPrice(self::TOTAL_PRICE_ENTERED_PRICE, 0.5)
        );
        // margin = discount = 0%, unit = 0.75x
        $this->assertEquals(92592525,
            $invoiceItemServices->calculateTotalPrice(self::TOTAL_PRICE_ENTERED_PRICE, 0.75)
        );
        // margin = discount = 0%, unit = 1x
        $this->assertEquals(123456700,
            $invoiceItemServices->calculateTotalPrice(self::TOTAL_PRICE_ENTERED_PRICE, 1)
        );
        // margin = discount = 0%, unit = 100x
        $this->assertEquals(12345670000,
            $invoiceItemServices->calculateTotalPrice(self::TOTAL_PRICE_ENTERED_PRICE, 100)
        );
        // margin = discount = 0%, unit = 99999999x
        $this->assertEquals(12345669876543300,
            $invoiceItemServices->calculateTotalPrice(self::TOTAL_PRICE_ENTERED_PRICE, 99999999)
        );
    }

    public function testCalculateTotalPriceNoMargin25_Discount()
    {
        $invoiceItemServices = new InvoiceItemServices();
        $margin = 0;
        $discount = 25;

        // margin = 0%, discount = 25%, unit = 0.25x
        $this->assertEquals(23148131,
            $invoiceItemServices->calculateTotalPrice(self::TOTAL_PRICE_ENTERED_PRICE, 0.25, $margin, $discount)
        );
        // margin = 0%, discount = 25%, unit = 0.5x
        $this->assertEquals(46296263,
            $invoiceItemServices->calculateTotalPrice(self::TOTAL_PRICE_ENTERED_PRICE, 0.5, $margin, $discount)
        );
        // margin = 0%, discount = 25%, unit = 0.75x
        $this->assertEquals(69444394,
            $invoiceItemServices->calculateTotalPrice(self::TOTAL_PRICE_ENTERED_PRICE, 0.75, $margin, $discount)
        );
        // margin = 0%, discount = 25%, unit = 100x
        $this->assertEquals(9259252500,
            $invoiceItemServices->calculateTotalPrice(self::TOTAL_PRICE_ENTERED_PRICE, 100, $margin, $discount)
        );
        // margin = 0%, discount = 25%, unit = 99999999x
        $this->assertEquals(9259252407407476,
            $invoiceItemServices->calculateTotalPrice(self::TOTAL_PRICE_ENTERED_PRICE, 99999999, $margin, $discount)
        );
        unset($margin,$discount);
    }

    public function testCalculateTotalPriceNoMargin50_Discount()
    {
        $invoiceItemServices = new InvoiceItemServices();
        $margin = 0;
        $discount = 50;
        // margin = 0%, discount = 25%, unit = 0.25x
        $this->assertEquals(15432088,
            $invoiceItemServices->calculateTotalPrice(self::TOTAL_PRICE_ENTERED_PRICE, 0.25, $margin, $discount)
        );
        // margin = 0%, discount = 25%, unit = 0.5x
        $this->assertEquals(30864175,
            $invoiceItemServices->calculateTotalPrice(self::TOTAL_PRICE_ENTERED_PRICE, 0.5, $margin, $discount)
        );
        // margin = 0%, discount = 25%, unit = 0.75x
        $this->assertEquals(46296263,
            $invoiceItemServices->calculateTotalPrice(self::TOTAL_PRICE_ENTERED_PRICE, 0.75, $margin, $discount)
        );
        // margin = 0%, discount = 25%, unit = 100x
        $this->assertEquals(6172835000,
            $invoiceItemServices->calculateTotalPrice(self::TOTAL_PRICE_ENTERED_PRICE, 100, $margin, $discount)
        );
        // margin = 0%, discount = 25%, unit = 99999999x
        $this->assertEquals(6172834938271650,
            $invoiceItemServices->calculateTotalPrice(self::TOTAL_PRICE_ENTERED_PRICE, 99999999, $margin, $discount)
        );
        unset($margin,$discount);
    }

    public function testCalculateTotalPriceNoMargin75_Discount()
    {
        $invoiceItemServices = new InvoiceItemServices();
        $margin = 0;
        $discount = 75;

        $this->assertEquals(7716044,
            $invoiceItemServices->calculateTotalPrice(self::TOTAL_PRICE_ENTERED_PRICE, 0.25, $margin, $discount)
        );
        $this->assertEquals(15432088,
            $invoiceItemServices->calculateTotalPrice(self::TOTAL_PRICE_ENTERED_PRICE, 0.5, $margin, $discount)
        );
        $this->assertEquals(23148131,
            $invoiceItemServices->calculateTotalPrice(self::TOTAL_PRICE_ENTERED_PRICE, 0.75, $margin, $discount)
        );
        $this->assertEquals(3086417500,
            $invoiceItemServices->calculateTotalPrice(self::TOTAL_PRICE_ENTERED_PRICE, 100, $margin, $discount)
        );
        $this->assertEquals(3086417469135825,
            $invoiceItemServices->calculateTotalPrice(self::TOTAL_PRICE_ENTERED_PRICE, 99999999, $margin, $discount)
        );
        unset($margin,$discount);
    }

    public function testCalculateTotalPriceNoMargin100_Discount()
    {
        $invoiceItemServices = new InvoiceItemServices();
        $margin = 0;
        $discount = 100;

        $this->assertEquals(0,
            $invoiceItemServices->calculateTotalPrice(self::TOTAL_PRICE_ENTERED_PRICE, 0.25, $margin, $discount)
        );
        $this->assertEquals(0,
            $invoiceItemServices->calculateTotalPrice(self::TOTAL_PRICE_ENTERED_PRICE, 0.5, $margin, $discount)
        );
        $this->assertEquals(0,
            $invoiceItemServices->calculateTotalPrice(self::TOTAL_PRICE_ENTERED_PRICE, 0.75, $margin, $discount)
        );
        $this->assertEquals(0,
            $invoiceItemServices->calculateTotalPrice(self::TOTAL_PRICE_ENTERED_PRICE, 100, $margin, $discount)
        );
        $this->assertEquals(0,
            $invoiceItemServices->calculateTotalPrice(self::TOTAL_PRICE_ENTERED_PRICE, 99999999, $margin, $discount)
        );
        unset($margin,$discount);
    }

    public function testCalculateTotalPrice25_Margin_0_Discount()
    {
        $invoiceItemServices = new InvoiceItemServices();
        $margin = 25;
        $discount = 0;

        $this->assertEquals(38580219,
            $invoiceItemServices->calculateTotalPrice(self::TOTAL_PRICE_ENTERED_PRICE, 0.25, $margin, $discount)
        );
        $this->assertEquals(77160438,
            $invoiceItemServices->calculateTotalPrice(self::TOTAL_PRICE_ENTERED_PRICE, 0.5, $margin, $discount)
        );
        $this->assertEquals(115740656,
            $invoiceItemServices->calculateTotalPrice(self::TOTAL_PRICE_ENTERED_PRICE, 0.75, $margin, $discount)
        );
        $this->assertEquals(154320875,
            $invoiceItemServices->calculateTotalPrice(self::TOTAL_PRICE_ENTERED_PRICE, 1, $margin, $discount)
        );
        $this->assertEquals(15277766625,
            $invoiceItemServices->calculateTotalPrice(self::TOTAL_PRICE_ENTERED_PRICE, 99, $margin, $discount)
        );
        $this->assertEquals(15432087345679124,
            $invoiceItemServices->calculateTotalPrice(self::TOTAL_PRICE_ENTERED_PRICE, 99999999, $margin, $discount)
        );
        unset($margin,$discount);
    }

    public function testCalculateTotalPrice50_Margin_0_Discount()
    {
        $invoiceItemServices = new InvoiceItemServices();
        $margin = 50;
        $discount = 0;

        $this->assertEquals(46296263,
            $invoiceItemServices->calculateTotalPrice(self::TOTAL_PRICE_ENTERED_PRICE, 0.25, $margin, $discount)
        );
        $this->assertEquals(92592525,
            $invoiceItemServices->calculateTotalPrice(self::TOTAL_PRICE_ENTERED_PRICE, 0.5, $margin, $discount)
        );
        $this->assertEquals(138888788,
            $invoiceItemServices->calculateTotalPrice(self::TOTAL_PRICE_ENTERED_PRICE, 0.75, $margin, $discount)
        );
        $this->assertEquals(185185050,
            $invoiceItemServices->calculateTotalPrice(self::TOTAL_PRICE_ENTERED_PRICE, 1, $margin, $discount)
        );
        $this->assertEquals(18333319950,
            $invoiceItemServices->calculateTotalPrice(self::TOTAL_PRICE_ENTERED_PRICE, 99, $margin, $discount)
        );
        $this->assertEquals(18518319814950,
            $invoiceItemServices->calculateTotalPrice(self::TOTAL_PRICE_ENTERED_PRICE, 99999, $margin, $discount)
        );
        $this->assertEquals(18518504814814952,
            $invoiceItemServices->calculateTotalPrice(self::TOTAL_PRICE_ENTERED_PRICE, 99999999, $margin, $discount)
        );
        unset($margin,$discount);
    }

    public function testCalculateTotalPrice75_Margin_0_Discount()
    {
        $invoiceItemServices = new InvoiceItemServices();
        $margin = 75;
        $discount = 0;

        $this->assertEquals(54012306,
            $invoiceItemServices->calculateTotalPrice(self::TOTAL_PRICE_ENTERED_PRICE, 0.25, $margin, $discount)
        );
        $this->assertEquals(108024613,
            $invoiceItemServices->calculateTotalPrice(self::TOTAL_PRICE_ENTERED_PRICE, 0.5, $margin, $discount)
        );
        $this->assertEquals(162036919,
            $invoiceItemServices->calculateTotalPrice(self::TOTAL_PRICE_ENTERED_PRICE, 0.75, $margin, $discount)
        );
        $this->assertEquals(216049225,
            $invoiceItemServices->calculateTotalPrice(self::TOTAL_PRICE_ENTERED_PRICE, 1, $margin, $discount)
        );
        $this->assertEquals(21388873275,
            $invoiceItemServices->calculateTotalPrice(self::TOTAL_PRICE_ENTERED_PRICE, 99, $margin, $discount)
        );
        $this->assertEquals(21604706450775,
            $invoiceItemServices->calculateTotalPrice(self::TOTAL_PRICE_ENTERED_PRICE, 99999, $margin, $discount)
        );
        $this->assertEquals(21604922283950776,
            $invoiceItemServices->calculateTotalPrice(self::TOTAL_PRICE_ENTERED_PRICE, 99999999, $margin, $discount)
        );
        unset($margin,$discount);
    }

    public function testCalculateTotalPrice100_Margin_0_Discount()
    {
        $invoiceItemServices = new InvoiceItemServices();
        $margin = 100;
        $discount = 0;

        $this->assertEquals(61728350,
            $invoiceItemServices->calculateTotalPrice(self::TOTAL_PRICE_ENTERED_PRICE, 0.25, $margin, $discount)
        );
        $this->assertEquals(123456700,
            $invoiceItemServices->calculateTotalPrice(self::TOTAL_PRICE_ENTERED_PRICE, 0.5, $margin, $discount)
        );
        $this->assertEquals(185185050,
            $invoiceItemServices->calculateTotalPrice(self::TOTAL_PRICE_ENTERED_PRICE, 0.75, $margin, $discount)
        );
        $this->assertEquals(246913400,
            $invoiceItemServices->calculateTotalPrice(self::TOTAL_PRICE_ENTERED_PRICE, 1, $margin, $discount)
        );
        $this->assertEquals(24444426600,
            $invoiceItemServices->calculateTotalPrice(self::TOTAL_PRICE_ENTERED_PRICE, 99, $margin, $discount)
        );
        $this->assertEquals(24691093086600,
            $invoiceItemServices->calculateTotalPrice(self::TOTAL_PRICE_ENTERED_PRICE, 99999, $margin, $discount)
        );
        $this->assertEquals(24691339753086600,
            $invoiceItemServices->calculateTotalPrice(self::TOTAL_PRICE_ENTERED_PRICE, 99999999, $margin, $discount)
        );
        unset($margin,$discount);
    }

    public function testCalculateTotalPrice_VariousMarginAndDiscount()
    {
        $invoiceItemServices = new InvoiceItemServices();
        $this->assertEquals(60805511,
            $invoiceItemServices->calculateTotalPrice(self::TOTAL_PRICE_ENTERED_PRICE, 0.25, 99, 1)
        );
        $this->assertEquals(81018460,
            $invoiceItemServices->calculateTotalPrice(self::TOTAL_PRICE_ENTERED_PRICE, 0.5, 75, 25)
        );
        $this->assertEquals(102981407,
            $invoiceItemServices->calculateTotalPrice(self::TOTAL_PRICE_ENTERED_PRICE, 0.75, 66, 33)
        );
        $this->assertEquals(92592525,
            $invoiceItemServices->calculateTotalPrice(self::TOTAL_PRICE_ENTERED_PRICE, 1, 50, 50)
        );
        $this->assertEquals(5526884880,
            $invoiceItemServices->calculateTotalPrice(self::TOTAL_PRICE_ENTERED_PRICE, 99, 33, 66)
        );
        $this->assertEquals(3857983319781,
            $invoiceItemServices->calculateTotalPrice(self::TOTAL_PRICE_ENTERED_PRICE, 99999, 25, 75)
        );
        $this->assertEquals(124691298753087,
            $invoiceItemServices->calculateTotalPrice(self::TOTAL_PRICE_ENTERED_PRICE, 99999999, 1, 99)
        );
    }

    // vatMultiplier 121 = 1,21
    public function testCalculateTotalPriceIncVat()
    {
        $invoiceItemServices = new InvoiceItemServices();
        $this->assertEquals(38580219,$invoiceItemServices->calculateTotalPriceIncVat(38580219,100));
        $this->assertEquals(81018460,$invoiceItemServices->calculateTotalPriceIncVat(77160438,105));
        $this->assertEquals(127314722,$invoiceItemServices->calculateTotalPriceIncVat(115740656,110));
        $this->assertEquals(177469006,$invoiceItemServices->calculateTotalPriceIncVat(154320875,115));
        $this->assertEquals(18333319950,$invoiceItemServices->calculateTotalPriceIncVat(15277766625,120));
        $this->assertEquals(18672825688271712,$invoiceItemServices->calculateTotalPriceIncVat(15432087345679100,121));
        $this->assertEquals(57870329,$invoiceItemServices->calculateTotalPriceIncVat(46296263,125));
        $this->assertEquals(92592525,$invoiceItemServices->calculateTotalPriceIncVat(92592525,100));
        $this->assertEquals(145833227,$invoiceItemServices->calculateTotalPriceIncVat(138888788,105));
        $this->assertEquals(203703555,$invoiceItemServices->calculateTotalPriceIncVat(185185050,110));
        $this->assertEquals(21083317943,$invoiceItemServices->calculateTotalPriceIncVat(18333319950,115));
        $this->assertEquals(22221983777940,$invoiceItemServices->calculateTotalPriceIncVat(18518319814950,120));
        $this->assertEquals(22407390825926148,$invoiceItemServices->calculateTotalPriceIncVat(18518504814815000,121));
        $this->assertEquals(67515383,$invoiceItemServices->calculateTotalPriceIncVat(54012306,125));
        $this->assertEquals(108024613,$invoiceItemServices->calculateTotalPriceIncVat(108024613,100));
        $this->assertEquals(170138765,$invoiceItemServices->calculateTotalPriceIncVat(162036919,105));
        $this->assertEquals(237654148,$invoiceItemServices->calculateTotalPriceIncVat(216049225,110));
        $this->assertEquals(24597204266,$invoiceItemServices->calculateTotalPriceIncVat(21388873275,115));
        $this->assertEquals(25925647740930,$invoiceItemServices->calculateTotalPriceIncVat(21604706450775,120));
        $this->assertEquals(26141955963580468,$invoiceItemServices->calculateTotalPriceIncVat(21604922283950800,121));
        $this->assertEquals(77160438,$invoiceItemServices->calculateTotalPriceIncVat(61728350,125));
        $this->assertEquals(123456700,$invoiceItemServices->calculateTotalPriceIncVat(123456700,100));
        $this->assertEquals(194444303,$invoiceItemServices->calculateTotalPriceIncVat(185185050,105));
        $this->assertEquals(271604740,$invoiceItemServices->calculateTotalPriceIncVat(246913400,110));
        $this->assertEquals(28111090590,$invoiceItemServices->calculateTotalPriceIncVat(24444426600,115));
        $this->assertEquals(29629311703920,$invoiceItemServices->calculateTotalPriceIncVat(24691093086600,120));
        $this->assertEquals(29876521101234784,$invoiceItemServices->calculateTotalPriceIncVat(24691339753086600,121));
        $this->assertEquals(76006889,$invoiceItemServices->calculateTotalPriceIncVat(60805511,125));
        $this->assertEquals(81018460,$invoiceItemServices->calculateTotalPriceIncVat(81018460,100));
        $this->assertEquals(108130477,$invoiceItemServices->calculateTotalPriceIncVat(102981407,105));
        $this->assertEquals(101851778,$invoiceItemServices->calculateTotalPriceIncVat(92592525,110));
        $this->assertEquals(6355917612,$invoiceItemServices->calculateTotalPriceIncVat(5526884880,115));
        $this->assertEquals(4629579983737,$invoiceItemServices->calculateTotalPriceIncVat(3857983319781,120));
        $this->assertEquals(150876471491235,$invoiceItemServices->calculateTotalPriceIncVat(124691298753087,121));
    }
}
