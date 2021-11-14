<?php

namespace App\Dto\Mapper;

use App\Dto\TariffDto;
use App\Entity\Tariff;
use App\Repository\VatRepository;

class TariffMapper implements MapperInterface
{
    private VatRepository $vatRepository;

    /**
     * @param VatRepository $vatRepository
     */
    public function __construct(VatRepository $vatRepository)
    {
        $this->vatRepository = $vatRepository;
    }

    /**
     * @inheritDoc
     */
    public function toEntity(object $dto): Tariff
    {
        return $this->fullFillEntity(new Tariff(), $dto);
    }

    /**
     * @param Tariff|object $existingItem
     * @param TariffDto|object $userData
     * @return Tariff|object
     */
    public function fullFillEntity(object $existingItem, object $userData): Tariff
    {
        $existingItem->setVat($this->vatRepository->find($userData->vat));
        $existingItem->setName($userData->name);
        $existingItem->setPrice($userData->price);
        return $existingItem;
    }

    /**
     * @inheritDoc
     */
    public function toDto(object $entity): TariffDto
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