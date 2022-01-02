<?php

namespace App\Tests\api;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;

class VatApiTest extends ApiTestCase implements ApiTestInterface
{
    use ApiTestTrait;

    private const URL = '/api/vats';
    private const BASE_URI = 'https://127.0.0.1:8000';

    private array $body = [
        "name" => "Test Vat name",
        'isDefault' => false,
        'percent' => 0,
        'multiplier' => 100,
    ];
    private array $bodyChanged = [
        "name" => "AAA Test Vat name ZZZ",
        'isDefault' => false,
        'percent' => 20,
        'multiplier' => 120,
    ];
}