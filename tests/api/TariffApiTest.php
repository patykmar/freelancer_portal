<?php

namespace App\Tests\api;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;

class TariffApiTest extends ApiTestCase implements ApiTestInterface
{
    use ApiTestTrait;

    private const URL = '/api/tariffs';
    private const BASE_URI = 'https://127.0.0.1:8000';

    private array $body = [
        'name' => "234 CZK per hour",
        'price' => 23400,
        'vat' => 6,
    ];
    private array $bodyChanged = [
        'name' => "432 CZK per hour",
        'price' => 43200,
        'vat' => 5,
    ];
}