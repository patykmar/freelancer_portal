<?php

namespace App\Entity;

use App\Repository\PriorityRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PriorityRepository::class)
 */
class Priority
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    private int $id = 0;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=100)
     */
    private string $name;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="float")
     */
    private float $coefficient_price;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="float")
     */
    private float $coefficient_time;

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
        return $this->coefficient_price;
    }

    public function setCoefficientPrice(int $coefficient_price): self
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
