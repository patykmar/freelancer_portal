<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\InvoiceRepository;
use App\Dto\In\InvoiceDto;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use DateTimeInterface;

/**
 * @ORM\Entity(repositoryClass=InvoiceRepository::class)
 * @ApiResource(
 *     input=InvoiceDto::class,
 *     output=InvoiceDto::class
 * )
 */
class Invoice
{
    /** @const int MAX_DUE_DAYS */
    public const MAX_DUE_DAYS = 130;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    private ?int $id = 0;

    /**
     * @ORM\ManyToOne(targetEntity=Company::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private Company $supplier;

    /**
     * @ORM\ManyToOne(targetEntity=Company::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private Company $subscriber;

    /**
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity=PaymentType::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private PaymentType $paymentType;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="smallint", options={"unsigned":true})
     */
    private int $due;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTimeInterface $invoiceCreated;

    /**
     * @ORM\Column(type="date")
     */
    private DateTimeInterface $dueDate;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private ?DateTimeInterface $paymentDate = null;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private User $userCreated;

    /**
     * @ORM\Column(type="string", length=20, unique=true, nullable=true)
     */
    private ?string $vs = null;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private ?string $ks = null;

    /**
     * @ORM\OneToMany(targetEntity=InvoiceItem::class, mappedBy="invoice", orphanRemoval=true, cascade={"persist"})
     */
    private Collection $invoiceItems;

    /**
     * @ORM\OneToMany(targetEntity=WorkInventory::class, mappedBy="invoice")
     */
    private Collection $workInventories;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $name;

    public function __construct()
    {
        $this->invoiceItems = new ArrayCollection();
        $this->workInventories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSupplier(): Company
    {
        return $this->supplier;
    }

    public function setSupplier(Company $supplier): self
    {
        $this->supplier = $supplier;

        return $this;
    }

    public function getSubscriber(): Company
    {
        return $this->subscriber;
    }

    /**
     * @param Object|Company $subscriber
     * @return $this
     */
    public function setSubscriber(Company $subscriber): self
    {
        $this->subscriber = $subscriber;

        return $this;
    }

    public function getPaymentType(): paymentType
    {
        return $this->paymentType;
    }

    public function setPaymentType(paymentType $paymentType): self
    {
        $this->paymentType = $paymentType;

        return $this;
    }

    public function getDue(): ?int
    {
        return $this->due;
    }

    public function setDue(int $due): self
    {
        $this->due = $due;

        return $this;
    }

    public function getInvoiceCreated(): ?DateTimeInterface
    {
        return $this->invoiceCreated;
    }

    public function setInvoiceCreated(DateTimeInterface $invoiceCreated): self
    {
        $this->invoiceCreated = $invoiceCreated;

        return $this;
    }

    public function getDueDate(): ?DateTimeInterface
    {
        return $this->dueDate;
    }

    public function setDueDate(DateTimeInterface $dueDate): self
    {
        $this->dueDate = $dueDate;

        return $this;
    }

    public function getPaymentDate(): ?DateTimeInterface
    {
        return $this->paymentDate;
    }

    public function setPaymentDate(?DateTimeInterface $paymentDate): self
    {
        $this->paymentDate = $paymentDate;

        return $this;
    }

    public function getUserCreated(): User
    {
        return $this->userCreated;
    }

    /**
     * @param UserInterface|User $userCreated
     * @return $this
     */
    public function setUserCreated(User $userCreated): self
    {
        $this->userCreated = $userCreated;

        return $this;
    }

    public function getVs(): ?string
    {
        return $this->vs;
    }

    public function setVs(?string $vs): self
    {

        $this->vs = $vs;

        return $this;
    }

    public function getKs(): ?string
    {
        return $this->ks;
    }

    public function setKs(?string $ks): self
    {
        $this->ks = $ks;

        return $this;
    }

    /**
     * @return Collection|InvoiceItem[]
     */
    public function getInvoiceItems(): Collection
    {
        return $this->invoiceItems;
    }

    public function addInvoiceItem(InvoiceItem $invoiceItem): self
    {
        if (!$this->invoiceItems->contains($invoiceItem)) {
            $this->invoiceItems[] = $invoiceItem;
            $invoiceItem->setInvoice($this);
        }

        return $this;
    }

    public function removeInvoiceItem(InvoiceItem $invoiceItem): self
    {
        if ($this->invoiceItems->removeElement($invoiceItem)) {
            // set the owning side to null (unless already changed)
            if ($invoiceItem->getInvoice() === $this) {
                $invoiceItem->setInvoice(null);
            }
        }

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
            $workInventory->setInvoice($this);
        }

        return $this;
    }

    public function removeWorkInventory(WorkInventory $workInventory): self
    {
        if ($this->workInventories->removeElement($workInventory)) {
            // set the owning side to null (unless already changed)
            if ($workInventory->getInvoice() === $this) {
                $workInventory->setInvoice(null);
            }
        }

        return $this;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getVs() . '(' . $this->subscriber->getName() . ')';
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


}
