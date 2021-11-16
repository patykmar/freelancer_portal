<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\WorkInventoryRepository;
use App\Dto\Out\WorkInventoryDto;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use DateTimeInterface;

/**
 * @ORM\Entity(repositoryClass=WorkInventoryRepository::class)
 * @ApiResource(
 *     input=WorkInventoryDto::Class,
 *     output=WorkInventoryDto::Class
 * )
 */
class WorkInventory
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    private ?int $id = 0;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $description;

    /**
     * @ORM\ManyToOne(targetEntity=Tariff::class, inversedBy="workInventories")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Tariff $tariff;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTimeInterface $work_start;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?DateTimeInterface $work_end = null;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private ?User $user;

    /**
     * @ORM\ManyToOne(targetEntity=Invoice::class, inversedBy="workInventories")
     */
    private ?Invoice $invoice;

    /**
     * @ORM\ManyToOne(targetEntity=Company::class, inversedBy="workInventories")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Company $company;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private ?float $work_duration;

    /**
     * @ORM\OneToMany(targetEntity=Ticket::class, mappedBy="workInventory")
     */
    private Collection $tickets;

    public function __construct()
    {
        $this->tickets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTariff(): ?Tariff
    {
        return $this->tariff;
    }

    /**
     * @param Object|Tariff|null $tariff
     * @return $this
     */
    public function setTariff(?Tariff $tariff): self
    {
        $this->tariff = $tariff;

        return $this;
    }

    public function getWorkStart(): ?DateTimeInterface
    {
        return $this->work_start;
    }

    public function setWorkStart(DateTimeInterface $work_start): self
    {
        $this->work_start = $work_start;

        return $this;
    }

    public function getWorkEnd(): ?DateTimeInterface
    {
        return $this->work_end;
    }

    public function setWorkEnd(?DateTimeInterface $work_end): self
    {
        $this->work_end = $work_end;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param Object|User|null $user
     * @return $this
     */
    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getInvoice(): ?Invoice
    {
        return $this->invoice;
    }

    /**
     * @param Object|Invoice|null $invoice
     * @return $this
     */
    public function setInvoice(?Invoice $invoice): self
    {
        $this->invoice = $invoice;

        return $this;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    /**
     * @param Object|Company|null $company
     * @return $this
     */
    public function setCompany(?Company $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getWorkDuration(): ?float
    {
        return $this->work_duration;
    }

    /**
     * @param float|null $work_duration
     * @return $this
     */
    public function setWorkDuration(?float $work_duration): self
    {
        $this->work_duration = $work_duration;

        return $this;
    }

    /**
     * @return Collection|Ticket[]
     */
    public function getTickets(): Collection
    {
        return $this->tickets;
    }

    public function addTicket(Ticket $ticket): self
    {
        if (!$this->tickets->contains($ticket)) {
            $this->tickets[] = $ticket;
            $ticket->setWorkInventory($this);
        }

        return $this;
    }

    public function removeTicket(Ticket $ticket): self
    {
        if ($this->tickets->removeElement($ticket)) {
            // set the owning side to null (unless already changed)
            if ($ticket->getWorkInventory() === $this) {
                $ticket->setWorkInventory(null);
            }
        }

        return $this;
    }
}
