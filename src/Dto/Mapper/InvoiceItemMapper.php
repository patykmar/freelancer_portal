<?php

namespace App\Dto\Mapper;

use App\Dto\In\InvoiceItemDtoIn;
use App\Dto\Out\InvoiceItemDtoOut;
use App\Entity\InvoiceItem;
use App\Repository\InvoiceRepository;
use App\Repository\VatRepository;
use InvalidArgumentException;

class InvoiceItemMapper implements MapperInterface
{
    private InvoiceRepository $invoiceRepository;
    private VatRepository $vatRepository;

    /**
     * @param InvoiceRepository $invoiceRepository
     * @param VatRepository $vatRepository
     */
    public function __construct(InvoiceRepository $invoiceRepository, VatRepository $vatRepository)
    {
        $this->invoiceRepository = $invoiceRepository;
        $this->vatRepository = $vatRepository;
    }


    /**
     * @param InvoiceItemDtoIn|object $dto
     * @return InvoiceItem
     */
    public function toEntity(object $dto): InvoiceItem
    {
        return $this->fullFillEntity(new InvoiceItem(), $dto);
    }

    /**
     * @param InvoiceItem|object $existingItem
     * @param InvoiceItemDtoIn|object $userData
     * @return InvoiceItem
     */
    public function fullFillEntity(object $existingItem, object $userData): InvoiceItem
    {
        // can be null when creating new invoice with items
        !is_null($userData->invoice) && $existingItem->setInvoice($this->invoiceRepository->find($userData->invoice));
        $existingItem->setVat($this->vatRepository->find($userData->vat));
        $existingItem->setName($userData->name);
        $existingItem->setPrice($userData->price);
        $existingItem->setMargin($userData->margin);
        $existingItem->setDiscount($userData->discount);
        $existingItem->setUnitCount($userData->unitCount);
        return $existingItem;
    }

    /**
     * @param InvoiceItem|object $entity
     * @return InvoiceItemDtoOut
     */
    public function toDto(object $entity): InvoiceItemDtoOut
    {
        $invoiceItemDto = new InvoiceItemDtoOut();
        $invoiceItemDto->id = $entity->getId();
        $invoiceItemDto->name = $entity->getName();
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

    /**
     * When create new Invoice with their items I receive array of arrays (InvoiceItem), the array
     *
     * @param array $invoiceItemArray
     * @return InvoiceItemDtoIn
     */
    public function toDtoFromArray(array $invoiceItemArray): InvoiceItemDtoIn
    {
        if (
            isset($invoiceItemArray['name']) &&
            isset($invoiceItemArray['vat']) &&
            isset($invoiceItemArray['price']) &&
            isset($invoiceItemArray['margin']) &&
            isset($invoiceItemArray['discount']) &&
            isset($invoiceItemArray['unitCount']) &&
            (count($invoiceItemArray) == 6)
        ) {
            $invoiceItemDto = new InvoiceItemDtoIn();
            $invoiceItemDto->name = $invoiceItemArray['name'];
            $invoiceItemDto->vat = $invoiceItemArray['vat'];
            $invoiceItemDto->price = $invoiceItemArray['price'];
            $invoiceItemDto->margin = $invoiceItemArray['margin'];
            $invoiceItemDto->discount = $invoiceItemArray['discount'];
            $invoiceItemDto->unitCount = $invoiceItemArray['unitCount'];
            return $invoiceItemDto;
        }
        throw new InvalidArgumentException("Wrong format of Invoice Item");
    }
}