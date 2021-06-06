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
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    private int $id = 0;

    /**
     * @ORM\ManyToOne(targetEntity=Invoice::class, inversedBy="invoiceItems", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private Invoice $invoice;


    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @Assert\Positive()
     * @ORM\Column(type="float",options={"unsigned":true, "default": 0.0})
     */
    private float $unit_count;

    /**
     * @ORM\Column(type="bigint",options={"unsigned":true, "default": 0})
     */
    private int $price;

    /**
     * @Assert\Range(
     *     min = 0,
     *     max = 100,
     *     notInRangeMessage = "You must be between {{ min }}cm and {{ max }}cm tall to enter",
     *     )
     * @ORM\Column(type="smallint",options={"unsigned":true, "default": 0})
     */
    private int $discount = 0;

    /**
     * @ORM\Column(type="smallint", nullable=false, options={"unsigned":true, "default": 0})
     */
    private int $margin = 0;

    /**
     * @ORM\Column(type="bigint", options={"unsigned":true, "default": 0})
     */
    private int $discount_total = 0;

    /**
     * @ORM\Column(type="bigint", options={"unsigned":true, "default": 0})
     */
    private int $margin_total = 0;

    /**
     * @ORM\Column(type="bigint", options={"unsigned":true, "default": 0})
     */
    private int $price_total = 0;

    /**
     * @ORM\Column(type="bigint", options={"unsigned":true, "default": 0})
     */
    private int $price_total_inc_vat = 0;

    /**
     * @ORM\ManyToOne(targetEntity=Vat::class, inversedBy="invoiceItems")
     * @ORM\JoinColumn(nullable=false)
     */
    private Vat $vat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInvoice(): ?invoice
    {
        return $this->invoice;
    }

    public function setInvoice(?invoice $invoice): self
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

    public function __toString()
    {
        return $this->getName();
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

    public function getMarginTotal(): ?int
    {
        return $this->margin_total;
    }

    public function setMarginTotal(int $margin_total): self
    {
        $this->margin_total = $margin_total;

        return $this;
    }

    public function getPriceTotal(): ?int
    {
        return $this->price_total;
    }

    public function setPriceTotal(int $price_total): self
    {
        $this->price_total = $price_total;

        return $this;
    }

    public function getPriceTotalIncVat(): ?int
    {
        return $this->price_total_inc_vat;
    }

    public function setPriceTotalIncVat(int $price_total_inc_vat): self
    {
        $this->price_total_inc_vat = $price_total_inc_vat;

        return $this;
    }

    /**
     * @return Vat
     */
    public function getVat(): Vat
    {
        return $this->vat;
    }

    public function setVat(Vat $vat): self
    {
        $this->vat = $vat;

        return $this;
    }
}
