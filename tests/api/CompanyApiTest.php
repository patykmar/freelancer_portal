<?php

namespace App\Tests\api;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class CompanyApiTest extends ApiTestCase
{

    /**
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
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

        /** @var ResponseInterface $response */
        $response = static::createClient()->request('GET','/api/companies', $options);

        $jsonData = json_decode($response->getContent(), true);
        self::assertNotEmpty($jsonData['hydra:member']);
    }
}