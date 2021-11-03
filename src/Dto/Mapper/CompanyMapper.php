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
        return $companyDto
            ->setId($entity->getId())
            ->setName($entity->getName())
            ->setDescription($entity->getDescription())
            ->setCompanyId($entity->getCompanyId())
            ->setVatNumber($entity->getVatNumber())
            ->setCreated($entity->getCreated())
            ->setModify($entity->getModify())
            ->setStreet($entity->getStreet())
            ->setCity($entity->getCity())
            ->setZipCode($entity->getZipCode())
            ->setCountry($entity->getCountry()->getId())
            ->setAccountNumber($entity->getAccountNumber())
            ->setIban($entity->getIban())
            ->setIsSupplier($entity->getIsSupplier());
    }
}