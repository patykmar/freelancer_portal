<?php

namespace App\DataTransformer\Input;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Dto\Mapper\InvoiceItemMapper;
use App\Entity\InvoiceItem;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

class InvoiceItemInputDataTransformer implements DataTransformerInterface
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
    public function transform($object, string $to, array $context = [])
    {
        if (isset($context[AbstractNormalizer::OBJECT_TO_POPULATE])) {
            // PUT method
            return $this->invoiceItemMapper->fullFillEntity(
                $context[AbstractNormalizer::OBJECT_TO_POPULATE],
                $object
            );
        } else {
            // POST method
            return $this->invoiceItemMapper->toEntity($object);
        }
    }

    /**
     * @inheritDoc
     */
    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        if ($data instanceof InvoiceItem) {
            return false;
        }
        return InvoiceItem::class === $to && null !== ($context['input']['class'] ?? null);

    }
}