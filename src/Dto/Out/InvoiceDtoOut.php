<?php

namespace App\Dto\Out;

class InvoiceDtoOut
{
    public ?int $id;
    public array $supplier;
    public array $subscriber;
    public array $paymentType;
    public int $due;
    public int $invoiceCreated;
    public int $dueDate;
    public ?int $paymentDate;
    public array $userCreated;
    public ?string $vs;
    public ?string $ks;
    public array $invoiceItems;
    public array $workInventories;
    public ?string $name;

}