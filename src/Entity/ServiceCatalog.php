<?php

namespace App\Entity;

use App\Repository\ServiceCatalogRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ServiceCatalogRepository::class)
 */
class ServiceCatalog
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
     * @ORM\Column(type="text")
     */
    private string $description;

    /**
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    private int $price;

    /**
     * @ORM\ManyToOne(targetEntity=vat::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Vat $vat;

    /**
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    private int $estimateTimeDelivery;

    /**
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    private int $estimateTimeReaction;

    /**
     * @ORM\Column(type="boolean", nullable=true, options={"default":false})
     */
    private bool $isDisable;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getVat(): ?vat
    {
        return $this->vat;
    }

    public function setVat(?vat $vat): self
    {
        $this->vat = $vat;

        return $this;
    }

    public function getEstimateTimeDelivery(): ?int
    {
        return $this->estimateTimeDelivery;
    }

    public function setEstimateTimeDelivery(int $estimateTimeDelivery): self
    {
        $this->estimateTimeDelivery = $estimateTimeDelivery;

        return $this;
    }

    public function getEstimateTimeReaction(): ?int
    {
        return $this->estimateTimeReaction;
    }

    public function setEstimateTimeReaction(int $estimateTimeReaction): self
    {
        $this->estimateTimeReaction = $estimateTimeReaction;

        return $this;
    }

    public function getIsDisable(): ?bool
    {
        return $this->isDisable;
    }

    public function setIsDisable(?bool $isDisable): self
    {
        $this->isDisable = $isDisable;

        return $this;
    }
}
