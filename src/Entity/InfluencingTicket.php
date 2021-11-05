<?php

namespace App\Entity;

use App\Repository\InfluencingTicketRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InfluencingTicketRepository::class)
 */
class InfluencingTicket
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    private int $id = 0;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private string $name;

    /**
     * @ORM\Column(type="float")
     */
    private float $coefficientPrice;

    /**
     * @ORM\Column(type="float")
     */
    private float $coefficientTime;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private bool $isForPriority;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private bool $isForImpact;

    public function __toString(): string
    {
        return $this->getName();
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

    public function getCoefficientPrice(): ?float
    {
        return $this->coefficientPrice;
    }

    public function setCoefficientPrice(float $coefficientPrice): self
    {
        $this->coefficientPrice = $coefficientPrice;

        return $this;
    }

    public function getCoefficientTime(): ?float
    {
        return $this->coefficientTime;
    }

    public function setCoefficientTime(float $coefficientTime): self
    {
        $this->coefficientTime = $coefficientTime;

        return $this;
    }

    public function getIsForPriority(): ?bool
    {
        return $this->isForPriority;
    }

    public function setIsForPriority(?bool $isForPriority): self
    {
        $this->isForPriority = $isForPriority;

        return $this;
    }

    public function getIsForImpact(): ?bool
    {
        return $this->isForImpact;
    }

    public function setIsForImpact(?bool $isForImpact): self
    {
        $this->isForImpact = $isForImpact;

        return $this;
    }
}
