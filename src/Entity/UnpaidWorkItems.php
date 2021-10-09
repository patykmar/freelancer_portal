<?php

namespace App\Entity;

use App\Repository\UnpaidWorkItemsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UnpaidWorkItemsRepository::class, readOnly=true)
 * @ORM\Table(name="v_unpaid_work_items")
 */
class UnpaidWorkItems
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id = 0;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $companyName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $tariffName;

    /**
     * @ORM\Column(type="float")
     */
    private float $workDurationTotal;

    /**
     * @ORM\Column(type="integer")
     */
    private int $pricePerUnit;

    /**
     * @ORM\Column(type="integer")
     */
    private int $totalPrice;

    public function getId(): int
    {
        return $this->id;
    }

    public function getCompanyName(): string
    {
        return $this->companyName;
    }

    public function setCompanyName(string $companyName): self
    {
        $this->companyName = $companyName;

        return $this;
    }

    public function getTariffName(): string
    {
        return $this->tariffName;
    }

    public function setTariffName(string $tariffName): self
    {
        $this->tariffName = $tariffName;

        return $this;
    }

    public function getWorkDurationTotal(): float
    {
        return $this->workDurationTotal;
    }

    public function setWorkDurationTotal(float $workDurationTotal): self
    {
        $this->workDurationTotal = $workDurationTotal;

        return $this;
    }

    public function getPricePerUnit(): int
    {
        return $this->pricePerUnit;
    }

    public function setPricePerUnit(int $pricePerUnit): self
    {
        $this->pricePerUnit = $pricePerUnit;

        return $this;
    }

    public function getTotalPrice(): int
    {
        return $this->totalPrice;
    }

    public function setTotalPrice(int $totalPrice): self
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }
}
