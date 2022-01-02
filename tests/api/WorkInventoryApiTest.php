<?php

namespace App\Tests\api;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;

class WorkInventoryApiTest extends ApiTestCase implements ApiTestInterface
{
    use ApiTestTrait;

    private const URL = '/api/work_inventories';
    private const BASE_URI = 'https://127.0.0.1:8000';

    private array $body = [
        "description" => "Nulla massa metus, vestibulum ut eros a",
        'tariff' => 4,
        'workStart' => 1639629942,
//        'workEnd' => 1639704967,
        'user' => 1,
        'company' => 1,
    ];
    private array $bodyChanged = [
        "description" => "AAAA Nulla massa metus, vestibulum ZZZZ",
        'tariff' => 3,
        'workStart' => 163962000,
        'workEnd' => 1639704000,
        'user' => 2,
        'company' => 3,
    ];
}