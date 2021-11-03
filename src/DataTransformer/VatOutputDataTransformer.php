<?php

namespace App\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Dto\Mapper\VatMapper;
use App\Dto\VatDto;
use App\Entity\Vat;

class VatOutputDataTransformer implements DataTransformerInterface
{
    private VatMapper $vatMapper;

    /**
     * @param VatMapper $vatMapper
     */
    public function __construct(VatMapper $vatMapper)
    {
        $this->vatMapper = $vatMapper;
    }

    /**
     * @inheritDoc
     * @param Vat|Object $object
     */
    public function transform($object, string $to, array $context = [])
    {
        return $this->vatMapper->toDto($object);
    }

    /**
     * @inheritDoc
     */
    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return VatDto::class === $to && $data instanceof Vat;
    }
}