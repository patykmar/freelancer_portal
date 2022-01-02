<?php

namespace App\Entity;

use App\Repository\GeneralLogRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GeneralLogRepository::class)
 */
class GeneralLog
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id = 0;

    /**
     * @ORM\ManyToOne(targetEntity=Ci::class, inversedBy="logs")
     */
    private ?Ci $ci;

    /**
     * @ORM\ManyToOne(targetEntity=Ticket::class, inversedBy="logs")
     */
    private ?Ticket $ticket;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private User $user;

    /**
     * @ORM\Column(type="text")
     */
    private string $body;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTimeInterface $created;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTicket(): ?Ticket
    {
        return $this->ticket;
    }

    public function setTicket(?Ticket $ticket): self
    {
        $this->ticket = $ticket;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;

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
}
