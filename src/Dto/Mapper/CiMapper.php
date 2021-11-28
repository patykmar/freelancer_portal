<?php

namespace App\Dto\Mapper;

use App\Dto\In\CiDtoIn;
use App\Dto\Out\CiDtoOut;
use App\Entity\Ci;
use App\Repository\CiRepository;
use App\Repository\CompanyRepository;
use App\Repository\GeneralStateRepository;
use App\Repository\QueueRepository;
use App\Repository\TariffRepository;
use App\Repository\UserRepository;

class CiMapper implements MapperInterface
{
    private CiRepository $ciRepository;
    private UserRepository $userRepository;
    private GeneralStateRepository $generalStateRepository;
    private TariffRepository $tariffRepository;
    private CompanyRepository $companyRepository;
    private QueueRepository $queueRepository;

    /**
     * @param CiRepository $ciRepository
     * @param UserRepository $userRepository
     * @param GeneralStateRepository $generalStateRepository
     * @param TariffRepository $tariffRepository
     * @param CompanyRepository $companyRepository
     * @param QueueRepository $queueRepository
     */
    public function __construct(
        CiRepository           $ciRepository,
        UserRepository         $userRepository,
        GeneralStateRepository $generalStateRepository,
        TariffRepository       $tariffRepository,
        CompanyRepository      $companyRepository,
        QueueRepository        $queueRepository)
    {
        $this->ciRepository = $ciRepository;
        $this->userRepository = $userRepository;
        $this->generalStateRepository = $generalStateRepository;
        $this->tariffRepository = $tariffRepository;
        $this->companyRepository = $companyRepository;
        $this->queueRepository = $queueRepository;
    }


    /**
     * @param CiDtoIn|object $dto
     * @return Ci|object
     */
    public function toEntity(object $dto): object
    {
        return $this->fullFillEntity(new Ci(), $dto);
    }

    /**
     * @param Ci|object $existingItem
     * @param CiDtoIn|object $userData
     * @return Ci|object
     */
    public function fullFillEntity(object $existingItem, object $userData): object
    {
        !is_null($userData->parentCi) && $existingItem->setParentCi($this->ciRepository->find($userData->parentCi));
        $existingItem->setCreatedUser($this->userRepository->find($userData->createdUser));
        $existingItem->setState($this->generalStateRepository->find($userData->state));
        $existingItem->setTariff($this->tariffRepository->find($userData->tariff));
        $existingItem->setCompany($this->companyRepository->find($userData->company));
        $existingItem->setName($userData->name);
        $existingItem->setDescription($userData->description);
        $existingItem->setQueueTier1($this->queueRepository->find($userData->queueTier1));
        !is_null($userData->queueTier2) && $existingItem->setQueueTier2($this->queueRepository->find($userData->queueTier2));
        !is_null($userData->queueTier3) && $existingItem->setQueueTier3($this->queueRepository->find($userData->queueTier3));

        return $existingItem;
    }

    /**
     * @param Ci|object $entity
     * @return CiDtoOut|object
     */
    public function toDto(object $entity): object
    {
        $ciDto = new CiDtoOut();
        $ciDto->id = $entity->getId();
        $ciDto->name = $entity->getName();
        $ciDto->description = $entity->getDescription();
        !is_null($entity->getParentCi()) && $ciDto->parentCi['id'] = $entity->getParentCi()->getId();
        !is_null($entity->getParentCi()) && $ciDto->parentCi['name'] = $entity->getParentCi()->getName();
        $ciDto->createdUser['id'] = $entity->getCreatedUser()->getId();
        $ciDto->createdUser['name'] = $entity->getCreatedUser()->__toString();
        $ciDto->state['id'] = $entity->getState()->getId();
        $ciDto->state['name'] = $entity->getState()->getName();
        $ciDto->tariff['id'] = $entity->getTariff()->getId();
        $ciDto->tariff['name'] = $entity->getTariff()->getName();
        $ciDto->company['id'] = $entity->getCompany()->getId();
        $ciDto->company['name'] = $entity->getCompany()->getName();
        $ciDto->createdDateTime = date_timestamp_get($entity->getCreatedDateTime());
        $ciDto->queueTier1['id'] = $entity->getQueueTier1()->getId();
        $ciDto->queueTier1['name'] = $entity->getQueueTier1()->getName();

        if (!is_null($entity->getQueueTier2())) {
            $ciDto->queueTier2['id'] = $entity->getQueueTier2()->getId();
            $ciDto->queueTier2['name'] = $entity->getQueueTier2()->getName();
        }

        if (!is_null($entity->getQueueTier3())) {
            $ciDto->queueTier3['id'] = $entity->getQueueTier3()->getId();
            $ciDto->queueTier3['name'] = $entity->getQueueTier3()->getName();
        }

        return $ciDto;
    }
}