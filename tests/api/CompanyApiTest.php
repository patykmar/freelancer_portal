<?php

namespace App\Tests\api;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;

class CompanyApiTest extends ApiTestCase implements ApiTestInterface
{
    use ApiTestTrait;

    private const URL = '/api/companies';
    private const BASE_URI = 'https://127.0.0.1:8000';

    private array $body = [
        "name" => "FOXCONN CZ s.r.o.",
        "description" => "Consumer electronics",
        "companyId" => "25938002",
        "vatNumber" => "CZ25938002",
        "street" => "U Zámečku 27, Pardubičky",
        "city" => "Pardubice",
        "zipCode" => "530 03",
        "country" => 1
    ];
    private array $bodyChanged = [
        "name" => "F@XC@NN CZ sro",
        "description" => "electronicsConsumer ",
        "companyId" => "80022593",
        "vatNumber" => "3800CZ2592",
        "street" => "UZábičky 27, Pardumečku",
        "city" => "Paicerdub",
        "zipCode" => "555 77",
        "country" => 3
    ];
}