<?php

namespace App\Dto\In;

class InvoiceDtoIn
{
    public ?int $id;
    public int $supplier;
    public int $subscriber;
    public int $paymentType;
    public int $due;
    public int $userCreated;
    public ?string $ks = null;
    public ?string $name = null;
    public array $invoiceItems;
}