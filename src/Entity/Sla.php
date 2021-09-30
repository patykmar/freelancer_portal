<?php

namespace App\Entity;

use App\Repository\SlaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SlaRepository::class)
 */
class Sla
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    private int $id = 0;

    /**
     * @ORM\ManyToOne(targetEntity=tariff::class, inversedBy="slas")
     * @ORM\JoinColumn(nullable=false)
     */
    private Tariff $tariff;

    /**
     * @ORM\ManyToOne(targetEntity=InfluencingTicket::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private InfluencingTicket $priority;

    /**
     * @ORM\ManyToOne(targetEntity=TicketType::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private TicketType $ticketType;

    /**
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    private int $reactionTime;

    /**
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    private int $resolvedTime;

    /**
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    private int $priceMultiplier;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTariff(): ?tariff
    {
        return $this->tariff;
    }

    public function setTariff(?tariff $tariff): self
    {
        $this->tariff = $tariff;

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

    public function getTicketType(): ?TicketType
    {
        return $this->ticketType;
    }

    public function setTicketType(?TicketType $ticketType): self
    {
        $this->ticketType = $ticketType;

        return $this;
    }

    public function getReactionTime(): ?int
    {
        return $this->reactionTime;
    }

    public function setReactionTime(int $reactionTime): self
    {
        $this->reactionTime = $reactionTime;

        return $this;
    }

    public function getResolvedTime(): ?int
    {
        return $this->resolvedTime;
    }

    public function setResolvedTime(int $resolvedTime): self
    {
        $this->resolvedTime = $resolvedTime;

        return $this;
    }

    public function getPriceMultiplier(): ?int
    {
        return $this->priceMultiplier;
    }

    public function setPriceMultiplier(int $priceMultiplier): self
    {
        $this->priceMultiplier = $priceMultiplier;

        return $this;
    }
}
