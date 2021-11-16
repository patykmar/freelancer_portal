<?php

namespace App\DataTransformer\Output;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Dto\In\InvoiceDto;
use App\Dto\Mapper\InvoiceMapper;
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
     * @return InvoiceDto|object
     */
    public function transform($object, string $to, array $context = []): InvoiceDto
    {
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
        return InvoiceDto::class === $to && $data instanceof Invoice;
    }
}