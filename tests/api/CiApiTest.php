<?php

namespace App\Tests\api;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;

class CiApiTest extends ApiTestCase implements ApiTestInterface
{
    use ApiTestTrait;

    private const URL = '/api/cis';
    private const BASE_URI = 'https://127.0.0.1:8000';

    private array $body = [
        "parentCi" => 1,
        "createdUser" => 1,
        "state" => 1,
        "tariff" => 1,
        "company" => 1,
        "queueTier1" => 1,
        "queueTier2" => 2,
        "queueTier3" => 2,
        "name" => "Test name of CI",
        "description" => "Suspendisse ac nisi laoreet, vulputate augue eget, porttitor arcu."
    ];
    private array $bodyChanged = [
        "parentCi" => 2,
        "createdUser" => 2,
        "state" => 2,
        "tariff" => 2,
        "company" => 2,
        "queueTier1" => 2,
        "queueTier2" => 1,
        "queueTier3" => 1,
        "name" => "Test name of CI AAAAAA",
        "description" => "Suspendisse ac"
    ];
}