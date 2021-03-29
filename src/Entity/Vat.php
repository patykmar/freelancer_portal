<?php

namespace App\Entity;

use App\Repository\VatRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VatRepository::class)
 */
class Vat
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\Column(type="float")
     */
    private $multiplier;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isDefault;

    /**
     * @ORM\Column(type="smallint")
     */
    private $percent;

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

    public function getMultiplier(): ?float
    {
        return $this->multiplier;
    }

    public function setMultiplier(float $multiplier): self
    {
        $this->multiplier = $multiplier;

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

    public function getPercent(): ?int
    {
        return $this->percent;
    }

    public function setPercent(int $percent): self
    {
        $this->percent = $percent;

        return $this;
    }
}
