<?php

namespace App\Dto\Mapper;

use App\Dto\In\WorkInventoryDtoIn;
use App\Dto\Out\WorkInventoryDtoOut;
use App\Entity\WorkInventory;
use App\Repository\CompanyRepository;
use App\Repository\TariffRepository;
use App\Repository\UserRepository;
use DateTime;

class WorkInventoryMapper implements MapperInterface
{
    private TariffRepository $tariffRepository;
    private UserRepository $userRepository;
    private CompanyRepository $companyRepository;

    /**
     * @param TariffRepository $tariffRepository
     * @param UserRepository $userRepository
     * @param CompanyRepository $companyRepository
     */
    public function __construct(TariffRepository $tariffRepository, UserRepository $userRepository, CompanyRepository $companyRepository)
    {
        $this->tariffRepository = $tariffRepository;
        $this->userRepository = $userRepository;
        $this->companyRepository = $companyRepository;
    }

    /**
     * @inheritDoc
     */
    public function toEntity(object $dto): WorkInventory
    {
        return $this->fullFillEntity(new WorkInventory(), $dto);
    }

    /**
     * @inheritDoc
     */
    public function toDto(object $entity): WorkInventoryDtoOut
    {
        $workInventoryDtoOut = new WorkInventoryDtoOut();
        $workInventoryDtoOut->id = $entity->getId();
        $workInventoryDtoOut->description = $entity->getDescription();
        $workInventoryDtoOut->tariff['id'] = $entity->getTariff()->getId();
        $workInventoryDtoOut->tariff['name'] = $entity->getTariff()->getName();
        $workInventoryDtoOut->work_start = date_timestamp_get($entity->getWorkStart());
        $workInventoryDtoOut->work_end = date_timestamp_get($entity->getWorkEnd());
        $workInventoryDtoOut->user['id'] = $entity->getUser()->getId();
        $workInventoryDtoOut->user['name'] = $entity->getUser()->__toString();
        $workInventoryDtoOut->invoice = is_null($entity->getInvoice()) ? null : $entity->getInvoice()->getId();
        $workInventoryDtoOut->company['id'] = $entity->getCompany()->getId();
        $workInventoryDtoOut->company['name'] = $entity->getCompany()->getName();
        $workInventoryDtoOut->work_duration = $entity->getWorkDuration();
        return $workInventoryDtoOut;
    }

    /**
     * @param object|WorkInventory $existingItem
     * @param object|WorkInventoryDtoIn $userData
     * @return WorkInventory
     */
    public function fullFillEntity(object $existingItem, object $userData): WorkInventory
    {
        $existingItem->setDescription($userData->description);
        $existingItem->setTariff($this->tariffRepository->find($userData->tariff));
        $existingItem->setWorkStart(new DateTime("@$userData->work_start"));
        $existingItem->setUser($this->userRepository->find($userData->user));
        $existingItem->setCompany($this->companyRepository->find($userData->company));
        if (!is_null($userData->work_end)) {
            $existingItem->setWorkEnd(new DateTime("@$userData->work_end"));
        }
        return $existingItem;
    }
}