<?php

namespace App\DataTransformer\Output;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Dto\Mapper\WorkInventoryMapper;
use App\Dto\Out\WorkInventoryDtoOut;
use App\Entity\WorkInventory;

class WorkInventoryOutputDataTransformer implements DataTransformerInterface
{
    private WorkInventoryMapper $inventoryMapper;

    /**
     * @param WorkInventoryMapper $inventoryMapper
     */
    public function __construct(WorkInventoryMapper $inventoryMapper)
    {
        $this->inventoryMapper = $inventoryMapper;
    }

    /**
     * @inheritDoc
     */
    public function transform($object, string $to, array $context = [])
    {
        return $this->inventoryMapper->toDto($object);
    }

    /**
     * @inheritDoc
     */
    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return WorkInventoryDtoOut::class === $to && $data instanceof WorkInventory;
    }
}