<?php

namespace App\Entity;

use App\Repository\CompanyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use DateTime;
use DateTimeInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CompanyRepository::class)
 * @ApiResource
 */
class Company
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    private ?int $id = 0;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(max=255)
     */
    private string $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(max=255)
     */
    private string $description;

    /**
     * @ORM\Column(type="string", length=50, nullable=true, options={"default": null})
     * @Assert\Length(max=50)
     */
    private ?string $company_id = null;

    /**
     * @ORM\Column(type="string", length=50, nullable=true, options={"default": null})
     * @Assert\Length(max=50)
     */
    private ?string $vat_number = null;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\DateTime()
     */
    private DateTimeInterface $created;

    //options={"unsigned":true, "default": 0}
    /**
     * @ORM\Column(type="datetime", nullable=true, options={"default": null})
     * @Assert\DateTime()
     */
    private ?DateTimeInterface $modify = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, options={"default": null})
     * @Assert\Length(max=255)
     */
    private ?string $street = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, options={"default": null})
     * @Assert\Length(max=255)
     */
    private ?string $city = null;

    /**
     * @ORM\Column(type="string", length=20, nullable=true, options={"default": null})
     * @Assert\Length(max=20)
     */
    private ?string $zip_code = null;

    /**
     * @ORM\ManyToOne(targetEntity=Country::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private Country $country;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, options={"default": null})
     * @Assert\Length(max=255)
     */
    private ?string $account_number = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, options={"default": null})
     * @Assert\Iban(message="This is not a valid International Bank Account Number (IBAN).")
     * @Assert\Length(max=255)
     */
    private ?string $iban = null;

    /**
     * @ORM\OneToMany(targetEntity=WorkInventory::class, mappedBy="company", orphanRemoval=true)
     */
    private Collection $workInventories;

    /**
     * @ORM\Column(type="boolean", nullable=true, options={"default": false})
     */
    private bool $isSupplier;

    /**
     * @ORM\OneToMany(targetEntity=Ci::class, mappedBy="company")
     */
    private Collection $cis;

    public function __construct()
    {
        $this->setCreated(new DateTime());
        $this->workInventories = new ArrayCollection();
        $this->cis = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCompanyId(): ?string
    {
        return $this->company_id;
    }

    public function setCompanyId(?string $company_id): self
    {
        $this->company_id = $company_id;

        return $this;
    }

    public function getVatNumber(): ?string
    {
        return $this->vat_number;
    }

    public function setVatNumber(?string $vat_number): self
    {
        $this->vat_number = $vat_number;

        return $this;
    }

    public function getCreated(): ?DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function getModify(): DateTimeInterface
    {
        return $this->modify;
    }

    public function setModify(DateTimeInterface $modify): self
    {
        $this->modify = $modify;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(?string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->zip_code;
    }

    public function setZipCode(?string $zip_code): self
    {
        $this->zip_code = $zip_code;

        return $this;
    }

    public function getCountry(): ?country
    {
        return $this->country;
    }

    public function setCountry(country $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getAccountNumber(): ?string
    {
        return $this->account_number;
    }

    public function setAccountNumber(?string $account_number): self
    {
        $this->account_number = $account_number;

        return $this;
    }

    public function getIban(): ?string
    {
        return $this->iban;
    }

    public function setIban(?string $iban): self
    {
        $this->iban = $iban;

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
            $workInventory->setCompany($this);
        }

        return $this;
    }

    public function removeWorkInventory(WorkInventory $workInventory): self
    {
        if ($this->workInventories->removeElement($workInventory)) {
            // set the owning side to null (unless already changed)
            if ($workInventory->getCompany() === $this) {
                $workInventory->setCompany(null);
            }
        }

        return $this;
    }

    public function getIsSupplier(): bool
    {
        return $this->isSupplier;
    }

    public function setIsSupplier(bool $isSupplier): self
    {
        $this->isSupplier = $isSupplier;

        return $this;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getName();
    }

    //TODO: add SWIFT

    /**
     * @return Collection|Ci[]
     */
    public function getCis(): Collection
    {
        return $this->cis;
    }

    public function addCi(Ci $ci): self
    {
        if (!$this->cis->contains($ci)) {
            $this->cis[] = $ci;
            $ci->setCompany($this);
        }

        return $this;
    }

    public function removeCi(Ci $ci): self
    {
        if ($this->cis->removeElement($ci)) {
            // set the owning side to null (unless already changed)
            if ($ci->getCompany() === $this) {
                $ci->setCompany(null);
            }
        }

        return $this;
    }
}
