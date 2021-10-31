<?php

namespace App\Services;

use App\Entity\Company;
use App\Repository\CompanyRepository;

class CompanyServices
{
    private const DATETIME_FORMAT = 'Y-m-d H:i:s T';

    private CompanyRepository $companyRepository;

    /**
     * @param CompanyRepository $companyRepository
     */
    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }


    public function findAllForApi(): iterable
    {
        $returnArray = array();
        foreach ($this->companyRepository->findAll() as $companyItem) {
            $returnArray[] = [
                "id" => $companyItem->getId(),
                "name" => $companyItem->getName(),
                "description" => $companyItem->getDescription(),
                "company_id" => $companyItem->getCompanyId(),
                "vat_number" => $companyItem->getVatNumber(),
                "created" => $companyItem->getCreated()->format(self::DATETIME_FORMAT),
                "modify" => $companyItem->getModify()->format(self::DATETIME_FORMAT),
                "street" => $companyItem->getStreet(),
                "city" => $companyItem->getCity(),
                "zip_code" => $companyItem->getZipCode(),
                "country" => [
                    "id" => $companyItem->getCountry()->getId(),
                    "name" => $companyItem->getCountry()->getName(),
                    "iso3166alpha3" => $companyItem->getCountry()->getIso3166Alpha3(),
                ],
                "account_number" => $companyItem->getAccountNumber(),
                "iban" => $companyItem->getIban(),
                "isSupplier" => false,
            ];
        }
        return $returnArray;
    }

    public function findForApi(int $id): ?Company
    {
        return $this->companyRepository->find($id);
//        $companyItem->set
//        dd($companyItem);

//        return [
//            "id" => $companyItem->getId(),
//            "name" => $companyItem->getName(),
//            "description" => $companyItem->getDescription(),
//            "company_id" => $companyItem->getCompanyId(),
//            "vat_number" => $companyItem->getVatNumber(),
//            "created" => $companyItem->getCreated()->format(self::DATETIME_FORMAT),
//            "modify" => $companyItem->getModify()->format(self::DATETIME_FORMAT),
//            "street" => $companyItem->getStreet(),
//            "city" => $companyItem->getCity(),
//            "zip_code" => $companyItem->getZipCode(),
//            "country" => [
//                "id" => $companyItem->getCountry()->getId(),
//                "name" => $companyItem->getCountry()->getName(),
//                "iso3166alpha3" => $companyItem->getCountry()->getIso3166Alpha3(),
//            ],
//            "account_number" => $companyItem->getAccountNumber(),
//            "iban" => $companyItem->getIban(),
//            "isSupplier" => false,
//        ];


    }

}