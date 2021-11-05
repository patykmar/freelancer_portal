<?php

namespace App\Dto\Mapper;

use App\Dto\CompanyDto;

class CompanyMapper implements MapperInterface
{
    public function toEntity($dto)
    {
        // TODO: Implement toEntity() method.
    }

    public function toDto($entity)
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