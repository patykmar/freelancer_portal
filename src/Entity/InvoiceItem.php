<?php

namespace App\Entity;

use App\Repository\InvoiceItemRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=InvoiceItemRepository::class)
 * @ApiResource
 */
class InvoiceItem
{
    public const DIVISOR = 100;
    public const PRICE_DEFAULT_VALUE = 100;

    public const UNIT_COUNT_MIN_VALUE = 0.01;
    public const UNIT_COUNT_MAX_VALUE = 9999999999.99;
    public const UNIT_COUNT_STEP = 0.01;
    public const UNIT_COUNT_DEFAUL_VALUE = 1.0;

    public const DISCOUNT_DEFAUL_VALUE = 0;
    public const DISCOUNT_MIN_VALUE = 0;
    public const DISCOUNT_MAX_VALUE = 100;
    public const DISCOUNT_STEP_VALUE = 1;

    public const MARGIN_DEFAUL_VALUE = 0;
    public const MARGIN_MIN_VALUE = 0;
    public const MARGIN_MAX_VALUE = 9999;
    public const MARGIN_STEP_VALUE = 10;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    private ?int $id = 0;

    /**
     * @ORM\ManyToOne(targetEntity=Invoice::class, inversedBy="invoiceItems", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private Invoice $invoice;

    /**
     * @ORM\ManyToOne(targetEntity=Vat::class, inversedBy="invoiceItems")
     * @ORM\JoinColumn(nullable=false)
     */
    private Vat $vat;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @ORM\Column(type="bigint",options={"unsigned":true, "default": 0})
     */
    private int $price;

    /**
     * @ORM\Column(
     *     type="smallint",
     *     nullable=false,
     *     options={"unsigned":true, "default": 0, "comment": "in percent >= 0"})
     */
    private int $margin = 0;

    /**
     * @ORM\Column(
     *     type="bigint",
     *     nullable=false,
     *     options={"unsigned":true, "default": 0, "comment": "price/100 * margin"})
     */
    private int $margin_total = 0;

    /**
     * @ORM\Column(
     *     type="bigint",
     *     nullable=false,
     *     options={"unsigned":true, "default": 0, "comment": "price + margin"})
     */
    private int $price_inc_margin = 0;

    /**
     * @Assert\Range(
     *     min = 0,
     *     max = 100,
     *     notInRangeMessage = "You must be between {{ min }}cm and {{ max }}cm tall to enter",
     *     )
     * @ORM\Column(
     *     type="smallint",
     *     nullable=false,
     *     options={"unsigned":true, "default": 0, "comment":"percent discount >= 0"})
     */
    private int $discount = 0;

    /**
     * @ORM\Column(
     *     type="bigint",
     *     nullable=false,
     *     options={"unsigned":true, "default": 0, "comment":"(price_inc_margin)/100 * discount"})
     */
    private int $discount_total = 0;

    /**
     * @ORM\Column(
     *     type="bigint",
     *     nullable=false,
     *     options={"unsigned":true, "default": 0, "comment":"price_inc_margin - discount_total"})
     */
    private int $price_inc_margin_minus_discount = 0;

    /**
     * @ORM\Column(
     *     type="bigint",
     *     nullable=false,
     *     options={"unsigned":true, "default": 0, "comment":"(price_inc_margin - discount_total)*vat"})
     */
    private int $price_inc_margin_discount_multi_vat = 0;

    /**
     * @ORM\Column(
     *     type="bigint",
     *     nullable=false,
     *     options={"unsigned":true, "default": 0, "comment":"price_inc_margin*vat"})
     */
    private int $price_inc_margin_multi_vat = 0;

    /**
     * @Assert\Positive()
     * @Assert\Range(
     *     min = 0.01,
     *     max = 999999.99,
     *     notInRangeMessage="You must be between {{ min }}cm and {{ max }}cm tall to enter"
     * )
     * @ORM\Column(type="float",options={"unsigned":true, "default": 1.0})
     */
    private float $unit_count;

    /**
     * @ORM\Column(
     *     type="bigint",
     *     nullable=false,
     *     options={"unsigned":true, "default": 0, "comment":"price_inc_discount_multi_vat*unit_count"})
     */
    private int $total_price_inc_margin_discount_vat = 0;

    /**
     * @ORM\Column(
     *     type="bigint",
     *     nullable=false,
     *     options={"unsigned":true, "default": 0, "comment":"price_multi_vat*unit_count"})
     */
    private int $total_price_inc_margin_vat = 0;

    /**
     * @return string|null
     */
    public function __toString()
    {
        return $this->getName();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInvoice(): invoice
    {
        return $this->invoice;
    }

    public function setInvoice(invoice $invoice): self
    {
        $this->invoice = $invoice;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getUnitCount(): float
    {
        return $this->unit_count;
    }

    public function setUnitCount(float $unit_count): self
    {
        $this->unit_count = $unit_count;
        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;
        return $this;
    }

    public function getDiscount(): ?int
    {
        return $this->discount;
    }

    public function setDiscount(int $discount): self
    {
        $this->discount = $discount;
        return $this;
    }

    public function getMargin(): ?int
    {
        return $this->margin;
    }

    public function setMargin(int $margin): self
    {
        $this->margin = $margin;
        return $this;
    }

    public function getMarginTotal(): ?int
    {
        return $this->margin_total;
    }

    public function setMarginTotal(int $margin_total): self
    {
        $this->margin_total = $margin_total;
        return $this;
    }

    /**
     * @return int
     */
    public function getPriceIncMargin(): int
    {
        return $this->price_inc_margin;
    }

    /**
     * @param int $price_inc_margin
     * @return InvoiceItem
     */
    public function setPriceIncMargin(int $price_inc_margin): self
    {
        $this->price_inc_margin = $price_inc_margin;
        return $this;
    }


    public function getDiscountTotal(): ?int
    {
        return $this->discount_total;
    }

    public function setDiscountTotal(int $discount_total): self
    {
        $this->discount_total = $discount_total;
        return $this;
    }

    /**
     * @return int
     */
    public function getPriceIncMarginMinusDiscount(): int
    {
        return $this->price_inc_margin_minus_discount;
    }

    /**
     * @param int $price_inc_margin_minus_discount
     * @return InvoiceItem
     */
    public function setPriceIncMarginMinusDiscount(int $price_inc_margin_minus_discount): self
    {
        $this->price_inc_margin_minus_discount = $price_inc_margin_minus_discount;
        return $this;
    }

    /**
     * @return int
     */
    public function getPriceIncMarginDiscountMultiVat(): int
    {
        return $this->price_inc_margin_discount_multi_vat;
    }

    /**
     * @param int $price_inc_margin_discount_multi_vat
     * @return InvoiceItem
     */
    public function setPriceIncMarginDiscountMultiVat(int $price_inc_margin_discount_multi_vat): self
    {
        $this->price_inc_margin_discount_multi_vat = $price_inc_margin_discount_multi_vat;
        return $this;
    }

    /**
     * @return int
     */
    public function getPriceIncMarginMultiVat(): int
    {
        return $this->price_inc_margin_multi_vat;
    }

    /**
     * @param int $price_inc_margin_multi_vat
     * @return InvoiceItem
     */
    public function setPriceIncMarginMultiVat(int $price_inc_margin_multi_vat): self
    {
        $this->price_inc_margin_multi_vat = $price_inc_margin_multi_vat;
        return $this;
    }

    /**
     * @return Vat
     */
    public function getVat(): Vat
    {
        return $this->vat;
    }

    /**
     * @param Vat $vat
     * @return $this
     */
    public function setVat(Vat $vat): self
    {
        $this->vat = $vat;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalPriceIncMarginDiscountVat(): int
    {
        return $this->total_price_inc_margin_discount_vat;
    }

    /**
     * @param int $total_price_inc_margin_discount_vat
     * @return InvoiceItem
     */
    public function setTotalPriceIncMarginDiscountVat(int $total_price_inc_margin_discount_vat): self
    {
        $this->total_price_inc_margin_discount_vat = $total_price_inc_margin_discount_vat;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalPriceIncMarginVat(): int
    {
        return $this->total_price_inc_margin_vat;
    }

    /**
     * @param int $total_price_inc_margin_vat
     * @return InvoiceItem
     */
    public function setTotalPriceIncMarginVat(int $total_price_inc_margin_vat): self
    {
        $this->total_price_inc_margin_vat = $total_price_inc_margin_vat;
        return $this;
    }
}
