<?php

namespace App\Services;

use App\Dto\CompanyDto;
use App\Dto\Mapper\CompanyMapper;
use App\Repository\CompanyRepository;

class CompanyServices
{
    private CompanyRepository $companyRepository;
    private CompanyMapper $companyMapper;

    /**
     * @param CompanyRepository $companyRepository
     * @param CompanyMapper $companyMapper
     */
    public function __construct(CompanyRepository $companyRepository, CompanyMapper $companyMapper)
    {
        $this->companyRepository = $companyRepository;
        $this->companyMapper = $companyMapper;
    }


    public function findAllForApi(): iterable
    {
        $returnArray = array();
        foreach ($this->companyRepository->findAll() as $companyItem) {
            $returnArray[] = $this->companyMapper->toDto($companyItem);
        }
        return $returnArray;
    }

    public function findForApi(int $id): ?CompanyDto
    {
        return $this->companyMapper->toDto($this->companyRepository->find($id));
    }

}