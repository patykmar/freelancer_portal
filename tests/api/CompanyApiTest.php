<?php

namespace App\Tests\api;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class CompanyApiTest extends ApiTestCase
{

    /**
     * @throws TransportExceptionInterface
     */
    public function testCompanies(): void
    {
        $options = [
            'auth_basic' => null,
            'auth_bearer' => null,
            'query' => [],
            'headers' => ['accept' => ['application/ld+json']],
            'body' => '',
            'json' => null,
            'base_uri' => 'https://127.0.0.1:8000',
            'extra' => [],
        ];

        $response = static::createClient()->request('GET','/api/companies', $options);
        dump($response);
    }
}