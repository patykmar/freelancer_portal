<?php

namespace App\DataTransformer\Input;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Dto\Mapper\TariffMapper;
use App\Entity\Tariff;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

class TariffInputDataTransformer implements DataTransformerInterface
{
    private TariffMapper $tariffMapper;

    /**
     * @param TariffMapper $tariffMapper
     */
    public function __construct(TariffMapper $tariffMapper)
    {
        $this->tariffMapper = $tariffMapper;
    }

    /**
     * @inheritDoc
     */
    public function transform($object, string $to, array $context = [])
    {
        if (isset($context[AbstractNormalizer::OBJECT_TO_POPULATE])) {
            // PUT method
            return $this->tariffMapper->fullFillEntity(
                $context[AbstractNormalizer::OBJECT_TO_POPULATE],
                $object
            );
        } else {
            // POST method
            return $this->tariffMapper->toEntity($object);
        }
    }

    /**
     * @inheritDoc
     */
    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        if ($data instanceof Tariff) {
            return false;
        }
        return Tariff::class === $to && null !== ($context['input']['class'] ?? null);
    }
}