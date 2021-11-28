<?php

namespace App\Tests\api;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;

class CompanyApiTest extends ApiTestCase
{

    public function testCompanies(): void
    {
        $response = static::createClient()->request('GET','/');
    }
}