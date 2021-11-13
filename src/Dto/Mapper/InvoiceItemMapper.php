<?php

namespace App\Dto\Mapper;

use App\Dto\InvoiceItemDto;
use App\Entity\InvoiceItem;

class InvoiceItemMapper implements MapperInterface
{

    /**
     * @inheritDoc
     */
    public function toEntity(object $dto)
    {
        // TODO: Implement toEntity() method.
    }

    /**
     * @param InvoiceItem|object $entity
     * @return InvoiceItemDto
     */
    public function toDto(object $entity): InvoiceItemDto
    {
        $invoiceItemDto = new InvoiceItemDto();
        $invoiceItemDto->id = $entity->getId();
        $invoiceItemDto->invoice = $entity->getInvoice()->getId();
        $invoiceItemDto->vat['id'] = $entity->getVat()->getId();
        $invoiceItemDto->vat['name'] = $entity->getVat()->getName();
        $invoiceItemDto->price = $entity->getPrice();
        $invoiceItemDto->margin = $entity->getMargin();
        $invoiceItemDto->margin_total = $entity->getMarginTotal();
        $invoiceItemDto->price_inc_margin = $entity->getPriceIncMargin();
        $invoiceItemDto->discount = $entity->getDiscount();
        $invoiceItemDto->discount_total = $entity->getDiscountTotal();
        $invoiceItemDto->price_inc_margin_minus_discount = $entity->getPriceIncMarginMinusDiscount();
        $invoiceItemDto->price_inc_margin_discount_multi_vat = $entity->getPriceIncMarginDiscountMultiVat();
        $invoiceItemDto->price_inc_margin_multi_vat = $entity->getPriceIncMarginMultiVat();
        $invoiceItemDto->unit_count = $entity->getUnitCount();
        $invoiceItemDto->total_price_inc_margin_discount_vat = $entity->getTotalPriceIncMarginDiscountVat();
        $invoiceItemDto->total_price_inc_margin_vat = $entity->getTotalPriceIncMarginVat();
        return $invoiceItemDto;
    }
}