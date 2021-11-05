<?php

namespace App\Entity;

use App\Repository\GeneralStateRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GeneralStateRepository::class)
 */
class GeneralState
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
     * @ORM\Column(type="float", options={"default":1.0})
     */
    private float $coefficientPrice = 1.0;

    /**
     * @ORM\Column(type="boolean", nullable=true, options={"default":false})
     */
    private bool $isForTicket = false;

    /**
     * @ORM\Column(type="boolean", nullable=true, options={"default":false})
     */
    private bool $isForCi = false;

    /**
     * @ORM\Column(type="boolean", nullable=true, options={"default":false})
     */
    private bool $isForCloseState = false;

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

    public function getIsForTicket(): ?bool
    {
        return $this->isForTicket;
    }

    public function setIsForTicket(?bool $isForTicket): self
    {
        $this->isForTicket = $isForTicket;

        return $this;
    }

    public function getIsForCi(): ?bool
    {
        return $this->isForCi;
    }

    public function setIsForCi(?bool $isForCi): self
    {
        $this->isForCi = $isForCi;

        return $this;
    }

    public function getIsForCloseState(): ?bool
    {
        return $this->isForCloseState;
    }

    public function setIsForCloseState(?bool $isForCloseState): self
    {
        $this->isForCloseState = $isForCloseState;

        return $this;
    }
}
