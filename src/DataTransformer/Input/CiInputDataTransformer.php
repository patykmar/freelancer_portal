<?php

namespace App\DataTransformer\Input;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Dto\Mapper\CiMapper;
use App\Entity\Ci;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

class CiInputDataTransformer implements DataTransformerInterface
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
        if (isset($context[AbstractNormalizer::OBJECT_TO_POPULATE])) {
            // PUT method
            return $this->ciMapper->fullFillEntity(
                $context[AbstractNormalizer::OBJECT_TO_POPULATE],
                $object
            );
        } else {
            // POST method
            return $this->ciMapper->toEntity($object);
        }
    }

    /**
     * @inheritDoc
     */
    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        if ($data instanceof Ci) {
            return false;
        }
        return Ci::class === $to && null !== ($context['input']['class'] ?? null);
    }
}