<?php

namespace App\Entity;

use App\Repository\InvoiceItemRepository;
use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\ManyToOne(targetEntity=Invoice::class, inversedBy="invoiceItems")
     * @ORM\JoinColumn(nullable=false)
     */
    private $invoice;

    /**
     * @ORM\ManyToOne(targetEntity=Vat::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $vat;

    /**
     * @ORM\ManyToOne(targetEntity=Unit::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $unit;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="smallint")
     */
    private $unit_count;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $price;

    /**
     * @ORM\Column(type="smallint")
     */
    private $discount;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $margin;

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

    public function getVat(): ?vat
    {
        return $this->vat;
    }

    public function setVat(?vat $vat): self
    {
        $this->vat = $vat;

        return $this;
    }

    public function getUnit(): ?unit
    {
        return $this->unit;
    }

    public function setUnit(?unit $unit): self
    {
        $this->unit = $unit;

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
}
