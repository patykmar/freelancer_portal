<?php

namespace App\Entity;

use App\Repository\InvoiceItemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=InvoiceItemRepository::class)
 * @ApiResource
 */
class InvoiceItem
{
    //TODO: pridej referenci na tabulku VAT
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    private int $id;

    /**
     * @ORM\ManyToOne(targetEntity=Invoice::class, inversedBy="invoiceItems", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $invoice;



    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @Assert\Positive()
     * @ORM\Column(type="float")
     */
    private float $unit_count;

    /**
     * @ORM\Column(type="integer",options={"unsigned":true})
     */
    private int $price;

    /**
     * @Assert\Range(
     *     min = 0,
     *     max = 100,
     *     notInRangeMessage = "You must be between {{ min }}cm and {{ max }}cm tall to enter",
     *     )
     * @ORM\Column(type="smallint")
     */
    private int $discount = 0;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private int $margin = 0;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $discount_total = 0.0;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $margin_total = 0.0;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $price_total;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $price_total_inc_vat;

    /**
     * @ORM\OneToMany(targetEntity=Vat::class, mappedBy="invoiceItem")
     */
    private $vat;

    public function __construct()
    {
        $this->vat = new ArrayCollection();
    }

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

    public function getUnitCount(): ?float
    {
        return $this->unit_count;
    }

    public function setUnitCount(float $unit_count): self
    {
        $this->unit_count = $unit_count;

        return $this;
    }

    public function getPrice(): ?string
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

    /**
     * @return Collection|Vat[]
     */
    public function getVat(): Collection
    {
        return $this->vat;
    }

    public function addVat(Vat $vat): self
    {
        if (!$this->vat->contains($vat)) {
            $this->vat[] = $vat;
            $vat->setInvoiceItem($this);
        }

        return $this;
    }

    public function removeVat(Vat $vat): self
    {
        if ($this->vat->removeElement($vat)) {
            // set the owning side to null (unless already changed)
            if ($vat->getInvoiceItem() === $this) {
                $vat->setInvoiceItem(null);
            }
        }

        return $this;
    }

}
