<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\InvoiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use DateTime;
use DateTimeInterface;

/**
 * @ORM\Entity(repositoryClass=InvoiceRepository::class)
 * @ApiResource
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
    private int $id = 0;

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
    private PaymentType $payment_type;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="smallint", options={"unsigned":true})
     */
    private int $due;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTimeInterface $invoice_created;

    /**
     * @ORM\Column(type="date")
     */
    private DateTimeInterface $due_date;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private ?DateTime $payment_day = null;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private User $user_created;

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

    public function setSubscriber(Company $subscriber): self
    {
        $this->subscriber = $subscriber;

        return $this;
    }

    public function getPaymentType(): paymentType
    {
        return $this->payment_type;
    }

    public function setPaymentType(paymentType $payment_type): self
    {
        $this->payment_type = $payment_type;

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
        return $this->invoice_created;
    }

    public function setInvoiceCreated(DateTimeInterface $invoice_created): self
    {
        $this->invoice_created = $invoice_created;

        return $this;
    }

    public function getDueDate(): ?DateTimeInterface
    {
        return $this->due_date;
    }

    public function setDueDate(DateTimeInterface $due_date): self
    {
        $this->due_date = $due_date;

        return $this;
    }

    public function getPaymentDay(): ?DateTimeInterface
    {
        return $this->payment_day;
    }

    public function setPaymentDay(?DateTimeInterface $payment_day): self
    {
        $this->payment_day = $payment_day;

        return $this;
    }

    public function getUserCreated(): User
    {
        return $this->user_created;
    }

    /**
     * @param UserInterface|User $user_created
     * @return $this
     */
    public function setUserCreated(User $user_created): self
    {
        $this->user_created = $user_created;

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


}
