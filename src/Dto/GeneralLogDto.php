<?php

namespace App\Dto;

class GeneralLogDto
{
    public ?int $id;
    public ?int $ci;
    public ?int $ticket;
    public int $user;
    public string $body;
    public int $created;
}