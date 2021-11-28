<?php

namespace App\Dto\Out;

class VatDto
{
    public int $id;
    public string $name;
    public bool $isDefault;
    public int $percent;
    public int $multiplier;
}