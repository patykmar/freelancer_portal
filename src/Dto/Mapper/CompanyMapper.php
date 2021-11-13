<?php

namespace App\Dto\Mapper;

use App\Dto\CompanyDtoOut;
use App\Dto\CompanyDtoIn;
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
    public function toEntity($dto)
    {
        $companyEntity = new Company();
        $companyEntity->setName($dto->name);
        $companyEntity->setDescription($dto->description);
        $companyEntity->setCompanyId($dto->companyId);
        $companyEntity->setVatNumber($dto->vatNumber);
        $companyEntity->setStreet($dto->street);
        $companyEntity->setCity($dto->city);
        $companyEntity->setZipCode($dto->zipCode);
        $companyEntity->setCountry($this->countryRepository->find($dto->country));
        $companyEntity->setAccountNumber($dto->accountNumber);
        $companyEntity->setIban($dto->iban);
        $companyEntity->setIsSupplier($dto->isSupplier);
        return $companyEntity;
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