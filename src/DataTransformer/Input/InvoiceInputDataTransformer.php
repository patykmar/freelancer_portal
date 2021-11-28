<?php

namespace App\DataTransformer\Input;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Dto\Mapper\InvoiceMapper;
use App\Entity\Invoice;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

class InvoiceInputDataTransformer implements DataTransformerInterface
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
     * @inheritDoc
     */
    public function transform($object, string $to, array $context = [])
    {
        if (isset($context[AbstractNormalizer::OBJECT_TO_POPULATE])) {
            // PUT method
            return $this->invoiceMapper->fullFillEntity(
                $context[AbstractNormalizer::OBJECT_TO_POPULATE],
                $object
            );
        } else {
            // POST method
            return $this->invoiceMapper->toEntity($object);
        }
    }

    /**
     * @inheritDoc
     */
    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        if ($data instanceof Invoice) {
            return false;
        }
        return Invoice::class === $to && null !== ($context['input']['class'] ?? null);
    }
}