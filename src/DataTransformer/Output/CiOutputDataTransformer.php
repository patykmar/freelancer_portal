<?php

namespace App\DataTransformer\Output;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Dto\Mapper\CiMapper;
use App\Dto\Out\CiDtoOut;
use App\Entity\Ci;

class CiOutputDataTransformer implements DataTransformerInterface
{
    private CiMapper $ciMapper;

    /**
     * @param CiMapper $ciMapper
     */
    public function __construct(CiMapper $ciMapper)
    {
        $this->ciMapper = $ciMapper;
    }


    /**
     * @inheritDoc
     */
    public function transform($object, string $to, array $context = [])
    {
        return $this->ciMapper->toDto($object);
    }

    /**
     * @inheritDoc
     */
    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return CiDtoOut::class === $to && $data instanceof Ci;
    }
}