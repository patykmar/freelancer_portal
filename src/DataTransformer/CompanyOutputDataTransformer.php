<?php

namespace App\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Dto\CompanyDtoOut;
use App\Dto\Mapper\CompanyMapper;
use App\Entity\Company;

class CompanyOutputDataTransformer implements DataTransformerInterface
{

    private CompanyMapper $companyMapper;

    /**
     * @param CompanyMapper $companyMapper
     */
    public function __construct(CompanyMapper $companyMapper)
    {
        $this->companyMapper = $companyMapper;
    }

    /**
     * @param object $object
     * @param string $to
     * @param array $context
     * @return CompanyDtoOut|object
     */
    public function transform($object, string $to, array $context = [])
    {
        return $this->companyMapper->toDto($object);
    }

    /**
     * @inheritDoc
     */
    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return CompanyDtoOut::class === $to && $data instanceof Company;
    }
}