<?php

namespace App\Dto\Mapper;

use App\Dto\Out\WorkInventoryDto;
use App\Entity\WorkInventory;

class WorkInventoryMapper implements MapperInterface
{
    /**
     * @inheritDoc
     */
    public function toEntity(object $dto): WorkInventory
    {
        return new WorkInventory(); // TODO: Implement toEntity() method.
    }

    /**
     * @inheritDoc
     */
    public function toDto(object $entity): WorkInventoryDto
    {
        $workInventoryDto = new WorkInventoryDto();
        $workInventoryDto->id = $entity->getId();
        $workInventoryDto->description = $entity->getDescription();
        $workInventoryDto->tariff['id'] = $entity->getTariff()->getId();
        $workInventoryDto->tariff['name'] = $entity->getTariff()->getName();
        $workInventoryDto->work_start = $entity->getWorkStart();
        $workInventoryDto->work_end = $entity->getWorkEnd();
        $workInventoryDto->user['id'] = $entity->getUser()->getId();
        $workInventoryDto->user['name'] = $entity->getUser()->__toString();
        $workInventoryDto->invoice = is_null($entity->getInvoice()) ? null : $entity->getInvoice()->getId();
        $workInventoryDto->company['id'] = $entity->getCompany()->getId();
        $workInventoryDto->company['name'] = $entity->getCompany()->getName();
        $workInventoryDto->work_duration = $entity->getWorkDuration();
        return $workInventoryDto;
    }

    public function fullFillEntity(object $existingItem, object $userData): WorkInventory
    {
        return new WorkInventory(); // TODO: Implement fullFillEntity() method.
    }
}