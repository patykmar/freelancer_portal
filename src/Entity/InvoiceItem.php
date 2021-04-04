<?php

namespace App\Entity;

use App\Repository\InvoiceItemRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=InvoiceItemRepository::class)
 */
class InvoiceItem
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Invoice::class, inversedBy="invoiceItems", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $invoice;

    /**
     * @Assert\Range(
     *     min = 0,
     *     max = 100,
     *     notInRangeMessage = "You must be between {{ min }}cm and {{ max }}cm tall to enter",
     *     )
     * @ORM\Column(type="smallint")
     */
    private $vat;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @Assert\Positive()
     * @ORM\Column(type="smallint")
     */
    private $unit_count;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $price;

    /**
     * @Assert\Range(
     *     min = 0,
     *     max = 100,
     *     notInRangeMessage = "You must be between {{ min }}cm and {{ max }}cm tall to enter",
     *     )
     * @ORM\Column(type="smallint")
     */
    private $discount;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $margin;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $discount_total;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $margin_total;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $price_total;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $price_total_inc_vat;

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

    public function getVat(): int
    {
        return $this->vat;
    }

    public function setVat(int $vat): self
    {
        $this->vat = $vat;

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

    public function getUnitCount(): ?int
    {
        return $this->unit_count;
    }

    public function setUnitCount(int $unit_count): self
    {
        $this->unit_count = $unit_count;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
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

    public function setMargin(?int $margin): self
    {
        $this->margin = $margin;

        return $this;
    }

    public function __toString()
    {
        return $this->getName();
    }

    public function getDiscountTotal(): ?string
    {
        return $this->discount_total;
    }

    public function setDiscountTotal(string $discount_total): self
    {
        $this->discount_total = $discount_total;

        return $this;
    }

    public function getMarginTotal(): ?string
    {
        return $this->margin_total;
    }

    public function setMarginTotal(string $margin_total): self
    {
        $this->margin_total = $margin_total;

        return $this;
    }

    public function getPriceTotal(): ?string
    {
        return $this->price_total;
    }

    public function setPriceTotal(string $price_total): self
    {
        $this->price_total = $price_total;

        return $this;
    }

    public function getPriceTotalIncVat(): ?string
    {
        return $this->price_total_inc_vat;
    }

    public function setPriceTotalIncVat(string $price_total_inc_vat): self
    {
        $this->price_total_inc_vat = $price_total_inc_vat;

        return $this;
    }

}
