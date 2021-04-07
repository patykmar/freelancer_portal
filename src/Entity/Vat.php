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
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isDefault;

    /**
     * @ORM\Column(type="smallint")
     */
    private $percent;

    /**
     * @ORM\Column(type="decimal", precision=1, scale=2)
     */
    private $multiplier;

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

    public function setIsDefault(?bool $isDefault): self
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

    public function getMultiplier(): ?string
    {
        return $this->multiplier;
    }

    public function setMultiplier(string $multiplier): self
    {
        $this->multiplier = $multiplier;

        return $this;
    }
}
