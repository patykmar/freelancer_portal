<?php

namespace App\Entity;

use App\Repository\TicketTypeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=TicketTypeRepository::class)
 */
class TicketType
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    private int $id = 0;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=100)
     */
    private string $name;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=10)
     */
    private string $abbreviation;

    /**
     * @ORM\Column(type="boolean", options={"default": false})
     */
    private bool $isDisable = false;

    /**
     * @ORM\Column(type="float")
     */
    private float $coefficient_price;

    /**
     * @ORM\Column(type="float")
     */
    private float $coefficient_time;

    public function __toString()
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

    public function getAbbreviation(): ?string
    {
        return $this->abbreviation;
    }

    public function setAbbreviation(string $abbreviation): self
    {
        $this->abbreviation = $abbreviation;

        return $this;
    }

    public function getIsDisable(): ?bool
    {
        return $this->isDisable;
    }

    public function setIsDisable(bool $isDisable): self
    {
        $this->isDisable = $isDisable;

        return $this;
    }

    public function getCoefficientPrice(): ?float
    {
        return $this->coefficient_price;
    }

    public function setCoefficientPrice(float $coefficient_price): self
    {
        $this->coefficient_price = $coefficient_price;

        return $this;
    }

    public function getCoefficientTime(): ?float
    {
        return $this->coefficient_time;
    }

    public function setCoefficientTime(float $coefficient_time): self
    {
        $this->coefficient_time = $coefficient_time;

        return $this;
    }
}
