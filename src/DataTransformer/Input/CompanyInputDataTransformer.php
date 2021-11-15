<?php

namespace App\DataTransformer\Input;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Dto\Mapper\CompanyMapper;
use App\Entity\Company;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

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
        if (isset($context[AbstractNormalizer::OBJECT_TO_POPULATE])) {
            // PUT method
            return $this->companyMapper->fullFillEntity(
                $context[AbstractNormalizer::OBJECT_TO_POPULATE],
                $object
            );
        } else {
            // POST method
            return $this->companyMapper->toEntity($object);
        }
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