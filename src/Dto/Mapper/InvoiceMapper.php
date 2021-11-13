<?php

namespace App\Dto\Mapper;

use App\Dto\InvoiceDto;
use App\Entity\Invoice;

class InvoiceMapper implements MapperInterface
{
    private InvoiceItemMapper $invoiceItemMapper;

    /**
     * @param InvoiceItemMapper $invoiceItemMapper
     */
    public function __construct(InvoiceItemMapper $invoiceItemMapper)
    {
        $this->invoiceItemMapper = $invoiceItemMapper;
    }

    /**
     * @inheritDoc
     */
    public function toEntity(object $dto)
    {
        // TODO: Implement toEntity() method.
    }

    /**
     * @param Invoice|object $entity
     * @return InvoiceDto
     */
    public function toDto(object $entity): InvoiceDto
    {
        $invoiceDto = new InvoiceDto();
        $invoiceDto->id = $entity->getId();
        $invoiceDto->name = $entity->getName();
        $invoiceDto->supplier['id'] = $entity->getSupplier()->getId();
        $invoiceDto->supplier['name'] = $entity->getSupplier()->getName();
        $invoiceDto->subscriber['id'] = $entity->getSubscriber()->getId();
        $invoiceDto->subscriber['name'] = $entity->getSubscriber()->getName();
        $invoiceDto->paymentType['id'] = $entity->getPaymentType()->getId();
        $invoiceDto->paymentType['name'] = $entity->getPaymentType()->getName();
        $invoiceDto->due = $entity->getDue();
        $invoiceDto->dueDate = $entity->getDueDate();
        $invoiceDto->paymentDate = $entity->getPaymentDate();
        $invoiceDto->invoiceCreated = $entity->getInvoiceCreated();
        $invoiceDto->userCreated['id'] = $entity->getUserCreated()->getId();
        $invoiceDto->userCreated['name'] = $entity->getUserCreated()->getId();
        $invoiceDto->vs = $entity->getVs();
        $invoiceDto->ks = $entity->getKs();
        foreach ($entity->getInvoiceItems() as $invoiceItems) {
            $invoiceDto->invoiceItems[] = $this->invoiceItemMapper->toDto($invoiceItems);
        }

        return $invoiceDto;
    }
}