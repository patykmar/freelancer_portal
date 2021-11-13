<?php

namespace App\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Dto\Mapper\CompanyMapper;
use App\Entity\Company;

class CompanyInputDataTransformer implements DataTransformerInterface
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
     * @return Company|object
     */
    public function transform($object, string $to, array $context = [])
    {
        return $this->companyMapper->toEntity($object);
    }

    /**
     * @inheritDoc
     */
    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        if ($data instanceof Company) {
            return false;
        }
        return Company::class === $to && null !== ($context['input']['class'] ?? null);
    }
}