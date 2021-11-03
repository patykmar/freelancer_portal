<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\Company;
use App\Dto\CompanyDto;
use App\Services\CompanyServices;

final class CompanyDataProvider implements RestrictedDataProviderInterface, ContextAwareCollectionDataProviderInterface, ItemDataProviderInterface
{
    private CompanyServices $companyServices;

    /**
     * @param CompanyServices $companyServices
     */
    public function __construct(CompanyServices $companyServices)
    {
        $this->companyServices = $companyServices;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Company::class === $resourceClass;
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): iterable
    {
        return $this->companyServices->findAllForApi();
    }

    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): ?CompanyDto
    {
        return $this->companyServices->findForApi($id);
    }
}