<?php

namespace App\Dto\Mapper;

use App\Dto\VatDto;
use App\Entity\Vat;

class VatMapper implements MapperInterface
{
    public function toEntity(object $dto): Vat
    {
        return new Vat();// TODO: Implement toEntity() method.
    }

    /**
     * @param object|Vat
     * @return object|VatDto
     */
    public function toDto(object $entity): VatDto
    {
        $vatDto = new VatDto();
        $vatDto->id = $entity->getId();
        $vatDto->name = $entity->getName();
        $vatDto->isDefault = $entity->getIsDefault();
        $vatDto->percent = $entity->getPercent();
        $vatDto->multiplier = $entity->getMultiplier();
        return $vatDto;
    }

    public function fullFillEntity(object $existingItem, object $userData): Vat
    {
        return new Vat(); // TODO: Implement fullFillEntity() method.
    }
}