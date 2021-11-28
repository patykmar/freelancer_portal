<?php

namespace App\DataTransformer\Input;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Dto\Mapper\WorkInventoryMapper;
use App\Entity\WorkInventory;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

class WorkInventoryInputDataTransformer implements DataTransformerInterface
{
    private WorkInventoryMapper $workInventoryMapper;

    /**
     * @param WorkInventoryMapper $workInventoryMapper
     */
    public function __construct(WorkInventoryMapper $workInventoryMapper)
    {
        $this->workInventoryMapper = $workInventoryMapper;
    }

    /**
     * @param object $object
     * @param string $to
     * @param array $context
     * @return WorkInventory|object
     */
    public function transform($object, string $to, array $context = [])
    {
        if (isset($context[AbstractNormalizer::OBJECT_TO_POPULATE])) {
            // PUT method
            return $this->workInventoryMapper->fullFillEntity(
                $context[AbstractNormalizer::OBJECT_TO_POPULATE],
                $object
            );
        } else {
            // POST method
            return $this->workInventoryMapper->toEntity($object);
        }
    }

    /**
     * @inheritDoc
     */
    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        if ($data instanceof WorkInventory) {
            return false;
        }
        return WorkInventory::class === $to && null !== ($context['input']['class'] ?? null);
    }
}