<?php

namespace App\Dto\Mapper;

use App\Dto\TariffDto;

class TariffMapper implements MapperInterface
{

    /**
     * @inheritDoc
     */
    public function toEntity(object $dto)
    {
        // TODO: Implement toEntity() method.
    }

    /**
     * @inheritDoc
     */
    public function toDto(object $entity)
    {
        $tariffDto = new TariffDto();
        $tariffDto->id = $entity->getId();
        $tariffDto->name = $entity->getName();
        $tariffDto->price = $entity->getPrice();
        $tariffDto->vat['id'] = $entity->getVat()->getId();
        $tariffDto->vat['name'] = $entity->getVat()->getName();
        return $tariffDto;
    }
}