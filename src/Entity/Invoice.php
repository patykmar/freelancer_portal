<?php

namespace App\Entity;

use App\Repository\InvoiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InvoiceRepository::class)
 */
class Invoice
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Company::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $supplier;

    /**
     * @ORM\ManyToOne(targetEntity=Company::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $subscriber;

    /**
     * @ORM\ManyToOne(targetEntity=PaymentType::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $payment_type;

    /**
     * @ORM\Column(type="smallint")
     */
    private $due;

    /**
     * @ORM\Column(type="datetime")
     */
    private $invoice_created;

    /**
     * @ORM\Column(type="date")
     */
    private $due_date;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $payment_day;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user_created;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $vs;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $ks;

    /**
     * @ORM\OneToMany(targetEntity=InvoiceItem::class, mappedBy="invoice", orphanRemoval=true)
     */
    private $invoiceItems;

    public function __construct()
    {
        $this->invoiceItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSupplier(): ?Company
    {
        return $this->supplier;
    }

    public function setSupplier(?Company $supplier): self
    {
        $this->supplier = $supplier;

        return $this;
    }

    public function getSubscriber(): ?Company
    {
        return $this->subscriber;
    }

    public function setSubscriber(?Company $subscriber): self
    {
        $this->subscriber = $subscriber;

        return $this;
    }

    public function getPaymentType(): ?paymentType
    {
        return $this->payment_type;
    }

    public function setPaymentType(?paymentType $payment_type): self
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

    public function getInvoiceCreated(): ?\DateTimeInterface
    {
        return $this->invoice_created;
    }

    public function setInvoiceCreated(\DateTimeInterface $invoice_created): self
    {
        $this->invoice_created = $invoice_created;

        return $this;
    }

    public function getDueDate(): ?\DateTimeInterface
    {
        return $this->due_date;
    }

    public function setDueDate(\DateTimeInterface $due_date): self
    {
        $this->due_date = $due_date;

        return $this;
    }

    public function getPaymentDay(): ?\DateTimeInterface
    {
        return $this->payment_day;
    }

    public function setPaymentDay(?\DateTimeInterface $payment_day): self
    {
        $this->payment_day = $payment_day;

        return $this;
    }

    public function getUserCreated(): ?User
    {
        return $this->user_created;
    }

    public function setUserCreated(?User $user_created): self
    {
        $this->user_created = $user_created;

        return $this;
    }

    public function getVs(): ?string
    {
        return $this->vs;
    }

    public function setVs(string $vs): self
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
}
