<?php

namespace App\Tests\api;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use function PHPUnit\Framework\assertEquals;

class CompanyApiTest extends ApiTestCase
{
    private const URL = '/api/companies';

    private int $id = 0;

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

    /**
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function testCollections(): void
    {
        $content = self::createClient()
            ->request('GET', self::URL)
            ->getContent();
        $jsonData = json_decode($content, true);
        self::assertNotEmpty($jsonData['hydra:member']);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function testPostCompanies(): void
    {
        $response = self::createClient()
            ->request('POST', self::URL, [
                'json' => $this->body,
                'base_uri' => "https://127.0.0.1:8000"
            ]);
        self::assertResponseStatusCodeSame(201);

        $content = json_decode($response->getContent(), true);
        $this->id = $content['id'];

        assertEquals($this->body['name'], $content['name']);
        assertEquals($this->body['description'], $content['description']);
        assertEquals($this->body['companyId'], $content['companyId']);
        assertEquals($this->body['vatNumber'], $content['vatNumber']);
        assertEquals($this->body['street'], $content['street']);
        assertEquals($this->body['city'], $content['city']);
        assertEquals($this->body['zipCode'], $content['zipCode']);
        assertEquals($this->body['country'], $content['country']['id']);
    }

}