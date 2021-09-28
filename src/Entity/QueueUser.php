<?php

namespace App\Entity;

use App\Repository\QueueUserRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QueueUserRepository::class)
 */
class QueueUser
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    private int $id = 0;

    /**
     * @ORM\ManyToOne(targetEntity=queue::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private Queue $queue;

    /**
     * @ORM\ManyToOne(targetEntity=user::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private User $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQueue(): ?queue
    {
        return $this->queue;
    }

    public function setQueue(?queue $queue): self
    {
        $this->queue = $queue;

        return $this;
    }

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(?user $user): self
    {
        $this->user = $user;

        return $this;
    }
}
