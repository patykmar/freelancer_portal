<?php

namespace App\Dto\Mapper;

use App\Dto\Out\CompanyDtoOut;
use App\Dto\In\CompanyDtoIn;
use App\Entity\Company;
use App\Repository\CountryRepository;

class CompanyMapper implements MapperInterface
{
    private CountryRepository $countryRepository;

    /**
     * @param CountryRepository $countryRepository
     */
    public function __construct(CountryRepository $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    /**
     * @param CompanyDtoIn|object $dto
     * @return Company|object
     */
    public function toEntity($dto): Company
    {
        return $this->fullFillEntity(new Company(), $dto);
    }

    /**
     * @param Company|object $existingItem
     * @param CompanyDtoIn|object $userData
     * @return Company|object
     */
    public function fullFillEntity($existingItem, $userData): Company
    {
        $existingItem->setName($userData->name);
        $existingItem->setDescription($userData->description);
        $existingItem->setCompanyId($userData->companyId);
        $existingItem->setVatNumber($userData->vatNumber);
        $existingItem->setStreet($userData->street);
        $existingItem->setCity($userData->city);
        $existingItem->setZipCode($userData->zipCode);
        $existingItem->setCountry($this->countryRepository->find($userData->country));
        $existingItem->setAccountNumber($userData->accountNumber);
        $existingItem->setIban($userData->iban);
        $existingItem->setIsSupplier($userData->isSupplier);
        return $existingItem;
    }

    /**
     * @param Company|object $entity
     * @return CompanyDtoOut
     */
    public function toDto(object $entity): CompanyDtoOut
    {
        $companyDtoOut = new CompanyDtoOut();
        $companyDtoOut->id = $entity->getId();
        $companyDtoOut->name = $entity->getName();
        $companyDtoOut->description = $entity->getDescription();
        $companyDtoOut->companyId = $entity->getCompanyId();
        $companyDtoOut->vatNumber = $entity->getVatNumber();
        $companyDtoOut->created = $entity->getCreated();
        $companyDtoOut->modify = $entity->getModify();
        $companyDtoOut->street = $entity->getStreet();
        $companyDtoOut->city = $entity->getCity();
        $companyDtoOut->zipCode = $entity->getZipCode();
        $companyDtoOut->country['id'] = $entity->getCountry()->getId();
        $companyDtoOut->country['name'] = $entity->getCountry()->getName();
        $companyDtoOut->accountNumber = $entity->getAccountNumber();
        $companyDtoOut->iban = $entity->getIban();
        $companyDtoOut->isSupplier = $entity->getIsSupplier();
        return $companyDtoOut;
    }
}