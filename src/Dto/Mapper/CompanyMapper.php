<?php

namespace App\Dto\Mapper;

use App\Entity\Company;
use App\Dto\CompanyDto;
use Exception;

class CompanyMapper
{
    /**
     * @throws Exception
     */
    public function toEntity()
    {
        throw new Exception("Please implement me");
    }

    public function toDto(Company $company): ?CompanyDto
    {
        $companyDto = new CompanyDto();
        return $companyDto
            ->setId($company->getId())
            ->setName($company->getName())
            ->setDescription($company->getDescription())
            ->setCompanyId($company->getCompanyId())
            ->setVatNumber($company->getVatNumber())
            ->setCreated($company->getCreated())
            ->setModify($company->getModify())
            ->setStreet($company->getStreet())
            ->setCity($company->getCity())
            ->setZipCode($company->getZipCode())
            ->setCountry($company->getCountry()->getId())
            ->setAccountNumber($company->getAccountNumber())
            ->setIban($company->getIban())
            ->setIsSupplier($company->getIsSupplier());
    }
}