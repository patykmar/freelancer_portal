<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TariffRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=TariffRepository::class)
 * @ApiResource
 */
class Tariff
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    private ?int $id = 0;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    private int $price;

    /**
     * @ORM\OneToMany(targetEntity=WorkInventory::class, mappedBy="tariff", cascade={"persist"})
     */
    private Collection $workInventories;

    /**
     * @ORM\ManyToOne(targetEntity=Vat::class, inversedBy="tariffs")
     * @ORM\JoinColumn(nullable=false)
     */
    private Vat $vat;


    public function __construct()
    {
        $this->workInventories = new ArrayCollection();
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

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection|WorkInventory[]
     */
    public function getWorkInventories(): Collection
    {
        return $this->workInventories;
    }

    public function addWorkInventory(WorkInventory $workInventory): self
    {
        if (!$this->workInventories->contains($workInventory)) {
            $this->workInventories[] = $workInventory;
            $workInventory->setTarif($this);
        }

        return $this;
    }

    public function removeWorkInventory(WorkInventory $workInventory): self
    {
        if ($this->workInventories->removeElement($workInventory)) {
            // set the owning side to null (unless already changed)
            if ($workInventory->getTarif() === $this) {
                $workInventory->setTarif(null);
            }
        }

        return $this;
    }


    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }

    public function getVat(): ?Vat
    {
        return $this->vat;
    }

    /**
     * @param Vat|null $vat
     * @return $this
     */
    public function setVat(?Vat $vat): self
    {
        $this->vat = $vat;

        return $this;
    }
}
