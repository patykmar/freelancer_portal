<?php

namespace App\Entity;

use App\Repository\WorkInventoryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WorkInventoryRepository::class)
 */
class WorkInventory
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $describe;

    /**
     * @ORM\ManyToOne(targetEntity=Tariff::class, inversedBy="workInventories")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tariff;

    /**
     * @ORM\Column(type="datetime")
     */
    private $work_start;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $work_end;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Invoice::class, inversedBy="workInventories")
     */
    private $invoice;

    /**
     * @ORM\ManyToOne(targetEntity=Company::class, inversedBy="workInventories")
     * @ORM\JoinColumn(nullable=false)
     */
    private $company;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $work_duration;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescribe(): ?string
    {
        return $this->describe;
    }

    public function setDescribe(string $describe): self
    {
        $this->describe = $describe;

        return $this;
    }

    public function getTariff(): ?Tariff
    {
        return $this->tariff;
    }

    public function setTariff(?Tariff $tarif): self
    {
        $this->tariff = $tarif;

        return $this;
    }

    public function getWorkStart(): ?\DateTimeInterface
    {
        return $this->work_start;
    }

    public function setWorkStart(\DateTimeInterface $work_start): self
    {
        $this->work_start = $work_start;

        return $this;
    }

    public function getWorkEnd(): ?\DateTimeInterface
    {
        return $this->work_end;
    }

    public function setWorkEnd(?\DateTimeInterface $work_end): self
    {
        $this->work_end = $work_end;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getInvoice(): ?Invoice
    {
        return $this->invoice;
    }

    public function setInvoice(?Invoice $invoice): self
    {
        $this->invoice = $invoice;

        return $this;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getWorkDuration(): ?float
    {
        return $this->work_duration;
    }

    public function setWorkDuration(?float $work_duration): self
    {
        $this->work_duration = $work_duration;

        return $this;
    }
}
