<?php

namespace App\Tests\api;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;

class PaymentTypesApiTest extends ApiTestCase implements ApiTestInterface
{
    use ApiTestTrait;

    private const URL = '/api/payment_types';
    private const BASE_URI = 'https://127.0.0.1:8000';

    private array $body = [
        'name' => 'Test payment types',
        'isDefault' => false,
    ];
    private array $bodyChanged = [
        'name' => 'AAAAA Test payment ZZZZZZ',
        'isDefault' => false,
    ];
}