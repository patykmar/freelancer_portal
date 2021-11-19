<?php

namespace App\Dto\Mapper;

use App\Dto\Out\CiDtoOut;
use App\Entity\Ci;

class CiMapper implements MapperInterface
{

    /**
     * @inheritDoc
     */
    public function toEntity(object $dto): object
    {
        // TODO: Implement toEntity() method.
    }

    /**
     * @inheritDoc
     */
    public function fullFillEntity(object $existingItem, object $userData): object
    {
        // TODO: Implement fullFillEntity() method.
    }

    /**
     * @param Ci|object $entity
     * @return CiDtoOut|object
     */
    public function toDto(object $entity): object
    {
        $ciDto = new CiDtoOut();
        $ciDto->id = $entity->getId();
        !is_null($entity->getParentCi()) && $ciDto->parentCi['id'] = $entity->getParentCi()->getId();
        !is_null($entity->getParentCi()) && $ciDto->parentCi['name'] = $entity->getParentCi()->getName();
        $ciDto->createdUser['id'] = $entity->getCreatedUser()->getId();
        $ciDto->createdUser['name'] = $entity->getCreatedUser()->__toString();
        $ciDto->state['id'] = $entity->getState()->getId();
        $ciDto->state['name'] = $entity->getState()->getName();
        $ciDto->tariff['id'] = $entity->getTariff()->getId();
        $ciDto->tariff['name'] = $entity->getTariff()->getName();
        //TODO:

        return $ciDto;
    }
}