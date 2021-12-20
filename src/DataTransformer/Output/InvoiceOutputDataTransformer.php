<?php

namespace App\DataTransformer\Output;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Dto\Mapper\InvoiceMapper;
use App\Dto\Out\InvoiceDtoOut;
use App\Entity\Invoice;

class InvoiceOutputDataTransformer implements DataTransformerInterface
{
    private InvoiceMapper $invoiceMapper;

    /**
     * @param InvoiceMapper $invoiceMapper
     */
    public function __construct(InvoiceMapper $invoiceMapper)
    {
        $this->invoiceMapper = $invoiceMapper;
    }

    /**
     * @param object $object
     * @param string $to
     * @param array $context
     * @return InvoiceDtoOut|object
     */
    public function transform($object, string $to, array $context = []): InvoiceDtoOut
    {
        // show detail of invoice
        if (isset($context['operation_type']) && $context['operation_type'] === 'item') {
            return $this->invoiceMapper->toDtoItem($object);
        }

        // return value after POST operation, new item
        if (isset($context['operation_type']) && $context['operation_type'] === 'collection' && $context['collection_operation_name'] == "post") {
            return $this->invoiceMapper->toDtoItem($object);
        }

        //TODO: check if this row is using, it should be use when using get all items via API
        return $this->invoiceMapper->toDto($object);
    }

    /**
     * @param array|object $data
     * @param string $to
     * @param array $context
     * @return bool
     */
    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return InvoiceDtoOut::class === $to && $data instanceof Invoice;
    }
}