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
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    private int $id = 0;

    /**
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    private int $companyId = 0;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $companyName = '';

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $tariffName = '';

    /**
     * @ORM\Column(type="float")
     */
    private float $workDurationTotal = 0.0;

    /**
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    private int $pricePerUnit = 0;

    /**
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    private int $totalPrice;

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getCompanyId(): int
    {
        return $this->companyId;
    }

    public function getCompanyName(): string
    {
        return $this->companyName;
    }

    public function getTariffName(): string
    {
        return $this->tariffName;
    }

    public function getWorkDurationTotal(): float
    {
        return $this->workDurationTotal;
    }

    public function getPricePerUnit(): int
    {
        return $this->pricePerUnit;
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
