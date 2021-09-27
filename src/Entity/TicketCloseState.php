<?php

namespace App\Entity;

use App\Repository\TicketCloseStateRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TicketCloseStateRepository::class)
 */
class TicketCloseState
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
}
