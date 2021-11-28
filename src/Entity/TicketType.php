<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TicketTypeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=TicketTypeRepository::class)
 * @ApiResource
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
    private float $coefficientPrice;

    /**
     * @ORM\Column(type="float")
     */
    private float $coefficientTime;

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
}
