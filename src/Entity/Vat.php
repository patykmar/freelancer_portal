<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\VatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VatRepository::class)
 * @ApiResource
 */
class Vat
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @ORM\Column(type="boolean", nullable=true, options={"default": false})
     */
    private bool $isDefault = false;

    /**
     * @ORM\Column(type="smallint", options={"unsigned":true, "default": 0})
     */
    private int $percent;

    /**
     * @ORM\Column(type="smallint", options={"unsigned":true, "default": 0})
     */
    private int $multiplier;

    /**
     * @ORM\ManyToOne(targetEntity=InvoiceItem::class, inversedBy="vat")
     */
    private InvoiceItem $invoiceItem;

    /**
     * @ORM\OneToMany(targetEntity=InvoiceItem::class, mappedBy="vat")
     */
    private Collection $invoiceItems;

    /**
     * @ORM\OneToMany(targetEntity=Tariff::class, mappedBy="vat")
     */
    private Collection $tariffs;

    public function __construct()
    {
        $this->invoiceItems = new ArrayCollection();
        $this->tariffs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getIsDefault(): ?bool
    {
        return $this->isDefault;
    }

    public function setIsDefault(bool $isDefault): self
    {
        $this->isDefault = $isDefault;

        return $this;
    }

    public function getPercent(): int
    {
        return $this->percent;
    }

    public function setPercent(int $percent): self
    {
        $this->percent = $percent;

        return $this;
    }

    public function getMultiplier(): int
    {
        return $this->multiplier;
    }

    public function setMultiplier(int $multiplier): self
    {
        $this->multiplier = $multiplier;

        return $this;
    }

    public function getInvoiceItem(): ?InvoiceItem
    {
        return $this->invoiceItem;
    }

    public function setInvoiceItem(?InvoiceItem $invoiceItem): self
    {
        $this->invoiceItem = $invoiceItem;

        return $this;
    }

    /**
     * @return Collection|InvoiceItem[]
     */
    public function getInvoiceItems(): Collection
    {
        return $this->invoiceItems;
    }

    public function addInvoiceItem(InvoiceItem $invoiceItem): self
    {
        if (!$this->invoiceItems->contains($invoiceItem)) {
            $this->invoiceItems[] = $invoiceItem;
            $invoiceItem->setVat($this);
        }

        return $this;
    }

    public function removeInvoiceItem(InvoiceItem $invoiceItem): self
    {
        if ($this->invoiceItems->removeElement($invoiceItem)) {
            // set the owning side to null (unless already changed)
            if ($invoiceItem->getVat() === $this) {
                $invoiceItem->setVat(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Tariff[]
     */
    public function getTariffs(): Collection
    {
        return $this->tariffs;
    }

    public function addTariff(Tariff $tariff): self
    {
        if (!$this->tariffs->contains($tariff)) {
            $this->tariffs[] = $tariff;
            $tariff->setVat($this);
        }

        return $this;
    }

    public function removeTariff(Tariff $tariff): self
    {
        if ($this->tariffs->removeElement($tariff)) {
            // set the owning side to null (unless already changed)
            if ($tariff->getVat() === $this) {
                $tariff->setVat(null);
            }
        }

        return $this;
    }
}
