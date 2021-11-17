<?php

namespace App\Dto\In;

use DateTimeInterface;

class InvoiceDto
{
    public ?int $id;
    public array $supplier;
    public array $subscriber;
    public array $paymentType;
    public int $due;
    public DateTimeInterface $invoiceCreated;
    public DateTimeInterface $dueDate;
    public ?DateTimeInterface $paymentDate;
    public array $userCreated;
    public ?string $vs;
    public ?string $ks;
    public array $invoiceItems;
    public array $workInventories;
    public ?string $name;

}