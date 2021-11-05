<?php

namespace App\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Dto\Mapper\TariffMapper;
use App\Dto\TariffDto;
use App\Entity\Tariff;

class TariffOutputDataTransformer implements DataTransformerInterface
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
        return $this->tariffMapper->toDto($object);
    }

    /**
     * @inheritDoc
     */
    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return TariffDto::class === $to && $data instanceof Tariff;
    }
}