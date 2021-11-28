<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TariffRepository;
use App\Dto\In\TariffDtoIn;
use App\Dto\Out\TariffDtoOut;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=TariffRepository::class)
 * @ApiResource(
 *     input=TariffDtoIn::class,
 *     output=TariffDtoOut::class
 * )
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
     * @Assert\Range( min=0 )
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

    /**
     * @ORM\OneToMany(targetEntity=Sla::class, mappedBy="tariff", orphanRemoval=true)
     */
    private Collection $slas;


    public function __construct()
    {
        $this->workInventories = new ArrayCollection();
        $this->slas = new ArrayCollection();
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
            $workInventory->setTariff($this);
        }
        return $this;
    }

    public function removeWorkInventory(WorkInventory $workInventory): self
    {
        if ($this->workInventories->removeElement($workInventory)) {
            // set the owning side to null (unless already changed)
            if ($workInventory->getTariff() === $this) {
                $workInventory->setTariff(null);
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

    /**
     * @return Collection|Sla[]
     */
    public function getSlas(): Collection
    {
        return $this->slas;
    }

    public function addSla(Sla $sla): self
    {
        if (!$this->slas->contains($sla)) {
            $this->slas[] = $sla;
            $sla->setTariff($this);
        }
        return $this;
    }

    public function removeSla(Sla $sla): self
    {
        if ($this->slas->removeElement($sla)) {
            // set the owning side to null (unless already changed)
            if ($sla->getTariff() === $this) {
                $sla->setTariff(null);
            }
        }
        return $this;
    }
}
