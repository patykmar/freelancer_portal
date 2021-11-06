<?php

namespace App\Entity;

use App\Repository\TicketRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=TicketRepository::class)
 */
class Ticket
{

    public const MINUTE = 60;
    public const HOUR = 60 * self::MINUTE;
    public const DAY = 24 * self::HOUR;
    public const WEEK = 7 * self::DAY;
    public const WEEKEND = 2 * self::DAY;
    public const MONTH = 30 * self::DAY;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id = 0;

    /**
     * @ORM\ManyToOne(targetEntity=ServiceCatalog::class, inversedBy="tickets")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank
     */
    private ServiceCatalog $serviceCatalog;

    /**
     * @ORM\ManyToOne(targetEntity=Ci::class, inversedBy="tickets")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank()
     */
    private Ci $ci;

    /**
     * @ORM\ManyToOne(targetEntity=QueueUser::class)
     */
    private QueueUser $queueUser;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private User $userCreated;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private ?User $userResolved;

    /**
     * @ORM\ManyToOne(targetEntity=Ticket::class, inversedBy="childTickets")
     */
    private ?Ticket $parentTicket;

    /**
     * @ORM\OneToMany(targetEntity=Ticket::class, mappedBy="parentTicket")
     */
    private Collection $childTickets;

    /**
     * @ORM\ManyToOne(targetEntity=WorkInventory::class, inversedBy="tickets")
     */
    private WorkInventory $workInventory;

    /**
     * @ORM\ManyToOne(targetEntity=GeneralState::class)
     */
    private GeneralState $ticketCloseState;

    /**
     * @ORM\ManyToOne(targetEntity=GeneralState::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private GeneralState $ticketState;

    /**
     * @ORM\ManyToOne(targetEntity=TicketType::class)
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank()
     */
    private TicketType $ticketType;

    /**
     * @ORM\ManyToOne(targetEntity=InfluencingTicket::class)
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank()
     */
    private InfluencingTicket $priority;

    /**
     * @ORM\ManyToOne(targetEntity=InfluencingTicket::class)
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank()
     */
    private InfluencingTicket $impact;

    /**
     * @ORM\Column(type="string", length=200)
     * @Assert\NotBlank()
     */
    private string $descriptionTitle;

    /**
     * @ORM\Column(type="text")
     */
    private string $descriptionBody;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $closedNotes;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?DateTimeInterface $closedDatetime;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTimeInterface $reactionDatetime;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTimeInterface $deliveryDatetime;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTimeInterface $createdDatetime;

    /**
     * @ORM\OneToMany(targetEntity=GeneralLog::class, mappedBy="ticket")
     */
    private Collection $logs;

    public function __construct()
    {
        $this->childTickets = new ArrayCollection();
        $this->logs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getServiceCatalog(): ?ServiceCatalog
    {
        return $this->serviceCatalog;
    }

    public function setServiceCatalog(?ServiceCatalog $serviceCatalog): self
    {
        $this->serviceCatalog = $serviceCatalog;

        return $this;
    }

    public function getCi(): ?Ci
    {
        return $this->ci;
    }

    public function setCi(?Ci $ci): self
    {
        $this->ci = $ci;

        return $this;
    }

    public function getQueueUser(): ?QueueUser
    {
        return $this->queueUser;
    }

    public function setQueueUser(?QueueUser $queueUser): self
    {
        $this->queueUser = $queueUser;

        return $this;
    }

    public function getUserCreated(): ?User
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

    public function getUserResolved(): ?User
    {
        return $this->userResolved;
    }

    public function setUserResolved(?User $userResolved): self
    {
        $this->userResolved = $userResolved;

        return $this;
    }

    public function getParentTicket(): ?self
    {
        return $this->parentTicket;
    }

    public function setParentTicket(?self $parentTicket): self
    {
        $this->parentTicket = $parentTicket;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getChildTickets(): Collection
    {
        return $this->childTickets;
    }

    public function addChildTicket(self $childTicket): self
    {
        if (!$this->childTickets->contains($childTicket)) {
            $this->childTickets[] = $childTicket;
            $childTicket->setParentTicket($this);
        }

        return $this;
    }

    public function removeChildTicket(self $childTicket): self
    {
        if ($this->childTickets->removeElement($childTicket)) {
            // set the owning side to null (unless already changed)
            if ($childTicket->getParentTicket() === $this) {
                $childTicket->setParentTicket(null);
            }
        }

        return $this;
    }

    public function getWorkInventory(): ?WorkInventory
    {
        return $this->workInventory;
    }

    public function setWorkInventory(?WorkInventory $workInventory): self
    {
        $this->workInventory = $workInventory;

        return $this;
    }

    public function getTicketCloseState(): ?GeneralState
    {
        return $this->ticketCloseState;
    }

    public function setTicketCloseState(?GeneralState $ticketCloseState): self
    {
        $this->ticketCloseState = $ticketCloseState;

        return $this;
    }

    public function getTicketState(): ?GeneralState
    {
        return $this->ticketState;
    }

    public function setTicketState(?GeneralState $ticketState): self
    {
        $this->ticketState = $ticketState;

        return $this;
    }

    public function getTicketType(): ?TicketType
    {
        return $this->ticketType;
    }

    public function setTicketType(?TicketType $ticketType): self
    {
        $this->ticketType = $ticketType;

        return $this;
    }

    public function getPriority(): ?InfluencingTicket
    {
        return $this->priority;
    }

    public function setPriority(?InfluencingTicket $priority): self
    {
        $this->priority = $priority;

        return $this;
    }

    public function getImpact(): ?InfluencingTicket
    {
        return $this->impact;
    }

    public function setImpact(?InfluencingTicket $impact): self
    {
        $this->impact = $impact;

        return $this;
    }

    public function getDescriptionTitle(): ?string
    {
        return $this->descriptionTitle;
    }

    public function setDescriptionTitle(string $descriptionTitle): self
    {
        $this->descriptionTitle = $descriptionTitle;

        return $this;
    }

    public function getDescriptionBody(): ?string
    {
        return $this->descriptionBody;
    }

    public function setDescriptionBody(string $descriptionBody): self
    {
        $this->descriptionBody = $descriptionBody;

        return $this;
    }

    public function getClosedNotes(): ?string
    {
        return $this->closedNotes;
    }

    public function setClosedNotes(?string $closedNotes): self
    {
        $this->closedNotes = $closedNotes;

        return $this;
    }

    public function getClosedDatetime(): ?DateTimeInterface
    {
        return $this->closedDatetime;
    }

    public function setClosedDatetime(?DateTimeInterface $closedDatetime): self
    {
        $this->closedDatetime = $closedDatetime;

        return $this;
    }

    public function getReactionDatetime(): ?DateTimeInterface
    {
        return $this->reactionDatetime;
    }

    public function setReactionDatetime(DateTimeInterface $reactionDatetime): self
    {
        $this->reactionDatetime = $reactionDatetime;

        return $this;
    }

    public function getDeliveryDatetime(): ?DateTimeInterface
    {
        return $this->deliveryDatetime;
    }

    public function setDeliveryDatetime(DateTimeInterface $deliveryDatetime): self
    {
        $this->deliveryDatetime = $deliveryDatetime;

        return $this;
    }

    public function getCreatedDatetime(): ?DateTimeInterface
    {
        return $this->createdDatetime;
    }

    public function setCreatedDatetime(DateTimeInterface $createdDatetime): self
    {
        $this->createdDatetime = $createdDatetime;

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
            $log->setTicket($this);
        }

        return $this;
    }

    public function removeLog(GeneralLog $log): self
    {
        if ($this->logs->removeElement($log)) {
            // set the owning side to null (unless already changed)
            if ($log->getTicket() === $this) {
                $log->setTicket(null);
            }
        }

        return $this;
    }
}
