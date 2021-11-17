<?php

namespace App\DataTransformer\Output;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Dto\Mapper\InvoiceItemMapper;
use App\Dto\Out\InvoiceItemDtoOut;
use App\Entity\InvoiceItem;

class InvoiceItemsOutputDataTransformer implements DataTransformerInterface
{
    private InvoiceItemMapper $invoiceItemMapper;

    /**
     * @param InvoiceItemMapper $invoiceItemsMapper
     */
    public function __construct(InvoiceItemMapper $invoiceItemsMapper)
    {
        $this->invoiceItemMapper = $invoiceItemsMapper;
    }

    /**
     * @inheritDoc
     */
    public function transform($object, string $to, array $context = []): InvoiceItemDtoOut
    {
        return $this->invoiceItemMapper->toDto($object);
    }

    /**
     * @inheritDoc
     */
    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return InvoiceItemDtoOut::class === $to && $data instanceof InvoiceItem;
    }
}