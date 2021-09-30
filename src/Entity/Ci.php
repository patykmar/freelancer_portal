<?php

namespace App\Entity;

use App\Repository\CiRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CiRepository::class)
 */
class Ci
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    private int $id = 0;

    /**
     * @ORM\ManyToOne(targetEntity=Ci::class, inversedBy="childCis")
     */
    private Ci $parentCi;

    /**
     * @ORM\OneToMany(targetEntity=Ci::class, mappedBy="parrentCi")
     */
    private Collection $childCis;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private User $createdUser;

    /**
     * @ORM\ManyToOne(targetEntity=GeneralState::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private GeneralState $state;

    /**
     * @ORM\ManyToOne(targetEntity=Tariff::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private Tariff $tariff;

    /**
     * @ORM\ManyToOne(targetEntity=Company::class, inversedBy="cis")
     * @ORM\JoinColumn(nullable=false)
     */
    private Company $company;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private string $name;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTimeInterface $createdDateTime;

    /**
     * @ORM\Column(type="text")
     */
    private string $description;

    /**
     * @ORM\ManyToOne(targetEntity=Queue::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private Queue $queueTier1;

    /**
     * @ORM\ManyToOne(targetEntity=Queue::class)
     */
    private ?Queue $queueTier2;

    /**
     * @ORM\ManyToOne(targetEntity=Queue::class)
     */
    private ?Queue $queueTier3;

    /**
     * @ORM\OneToMany(targetEntity=Ticket::class, mappedBy="ci")
     */
    private Collection $tickets;

    /**
     * @ORM\OneToMany(targetEntity=GeneralLog::class, mappedBy="ci")
     */
    private Collection $logs;

    public function __construct()
    {
        $this->childCis = new ArrayCollection();
        $this->tickets = new ArrayCollection();
        $this->logs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getParentCi(): ?self
    {
        return $this->parentCi;
    }

    public function setParentCi(?self $parentCi): self
    {
        $this->parentCi = $parentCi;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getChildCis(): Collection
    {
        return $this->childCis;
    }

    public function addChildCi(self $childCi): self
    {
        if (!$this->childCis->contains($childCi)) {
            $this->childCis[] = $childCi;
            $childCi->setParentCi($this);
        }

        return $this;
    }

    public function removeChildCi(self $childCi): self
    {
        if ($this->childCis->removeElement($childCi)) {
            // set the owning side to null (unless already changed)
            if ($childCi->getParentCi() === $this) {
                $childCi->setParentCi(null);
            }
        }

        return $this;
    }

    public function getCreatedUser(): ?User
    {
        return $this->createdUser;
    }

    public function setCreatedUser(?User $createdUser): self
    {
        $this->createdUser = $createdUser;

        return $this;
    }

    public function getState(): ?GeneralState
    {
        return $this->state;
    }

    public function setState(?GeneralState $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getTariff(): ?Tariff
    {
        return $this->tariff;
    }

    public function setTariff(?Tariff $tariff): self
    {
        $this->tariff = $tariff;

        return $this;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): self
    {
        $this->company = $company;

        return $this;
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

    public function getCreatedDateTime(): ?DateTimeInterface
    {
        return $this->createdDateTime;
    }

    public function setCreatedDateTime(DateTimeInterface $createdDateTime): self
    {
        $this->createdDateTime = $createdDateTime;

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

    public function getQueueTier1(): ?Queue
    {
        return $this->queueTier1;
    }

    public function setQueueTier1(?Queue $queueTier1): self
    {
        $this->queueTier1 = $queueTier1;

        return $this;
    }

    public function getQueueTier2(): ?Queue
    {
        return $this->queueTier2;
    }

    public function setQueueTier2(?Queue $queueTier2): self
    {
        $this->queueTier2 = $queueTier2;

        return $this;
    }

    public function getQueueTier3(): ?Queue
    {
        return $this->queueTier3;
    }

    /**
     * @param Queue|null $queueTier3
     * @return $this
     */
    public function setQueueTier3(?Queue $queueTier3): self
    {
        $this->queueTier3 = $queueTier3;

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
            $ticket->setCi($this);
        }

        return $this;
    }

    public function removeTicket(Ticket $ticket): self
    {
        if ($this->tickets->removeElement($ticket)) {
            // set the owning side to null (unless already changed)
            if ($ticket->getCi() === $this) {
                $ticket->setCi(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|GeneralLog[]
     */
    public function getLogs(): Collection
    {
        return $this->logs;
    }

    public function addLog(GeneralLog $log): self
    {
        if (!$this->logs->contains($log)) {
            $this->logs[] = $log;
            $log->setCi($this);
        }

        return $this;
    }

    public function removeLog(GeneralLog $log): self
    {
        if ($this->logs->removeElement($log)) {
            // set the owning side to null (unless already changed)
            if ($log->getCi() === $this) {
                $log->setCi(null);
            }
        }

        return $this;
    }
}
