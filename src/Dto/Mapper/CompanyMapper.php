<?php

namespace App\Dto\Mapper;

use App\Dto\CompanyDto;
use App\Entity\Company;

class CompanyMapper implements MapperInterface
{
    public function toEntity($dto)
    {
        // TODO: Implement toEntity() method.
    }

    /**
     * @param Company|object $entity
     * @return CompanyDto
     */
    public function toDto(object $entity): CompanyDto
    {
        $companyDto = new CompanyDto();
        $companyDto->id = $entity->getId();
        $companyDto->name = $entity->getName();
        $companyDto->description = $entity->getDescription();
        $companyDto->companyId = $entity->getCompanyId();
        $companyDto->vatNumber = $entity->getVatNumber();
        $companyDto->created = $entity->getCreated();
        $companyDto->modify = $entity->getModify();
        $companyDto->street = $entity->getStreet();
        $companyDto->city = $entity->getCity();
        $companyDto->zipCode = $entity->getZipCode();
        $companyDto->country['id'] = $entity->getCountry()->getId();
        $companyDto->country['name'] = $entity->getCountry()->getName();
        $companyDto->accountNumber = $entity->getAccountNumber();
        $companyDto->iban = $entity->getIban();
        $companyDto->isSupplier = $entity->getIsSupplier();
        return $companyDto;
    }
}