<?php

namespace App\Tests\api;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use function PHPUnit\Framework\assertEquals;

class CompanyApiTest extends ApiTestCase implements ApiTestInterface
{
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

    /**
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     * @return int
     */
    public function testPost(): int
    {
        $response = self::createClient()
            ->request('POST', self::URL, [
                'json' => $this->body,
                'base_uri' => self::BASE_URI
            ]);

        $this->assertResponseIsSuccessful();

        $content = json_decode($response->getContent(), true);

        assertEquals($this->body['name'], $content['name']);
        assertEquals($this->body['description'], $content['description']);
        assertEquals($this->body['companyId'], $content['companyId']);
        assertEquals($this->body['vatNumber'], $content['vatNumber']);
        assertEquals($this->body['street'], $content['street']);
        assertEquals($this->body['city'], $content['city']);
        assertEquals($this->body['zipCode'], $content['zipCode']);
        assertEquals($this->body['country'], $content['country']['id']);

        return $content['id'];
    }

    /**
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     * @depends testPost
     */
    public function testGetAll(): void
    {
        $content = self::createClient()
            ->request('GET', self::URL)
            ->getContent();
        $jsonData = json_decode($content, true);
        $this->assertNotEmpty($jsonData['hydra:member']);
    }

    /**
     * @depends testPost
     * @param int $id
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function testGetItem(int $id): void
    {
        $response = $this->createClient()
            ->request('GET', self::URL . '/' . $id, [
                'base_uri' => self::BASE_URI
            ]);

        $this->assertResponseIsSuccessful();

        $content = json_decode($response->getContent(), true);

        assertEquals($this->body['name'], $content['name']);
        assertEquals($this->body['description'], $content['description']);
        assertEquals($this->body['companyId'], $content['companyId']);
        assertEquals($this->body['vatNumber'], $content['vatNumber']);
        assertEquals($this->body['street'], $content['street']);
        assertEquals($this->body['city'], $content['city']);
        assertEquals($this->body['zipCode'], $content['zipCode']);
        assertEquals($this->body['country'], $content['country']['id']);
    }

    /**
     * @param int $id
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     * @depends testPost
     */
    public function testPut(int $id): void
    {
        $response = $this->createClient()
            ->request('PUT', self::URL . '/' . $id, [
                'json' => $this->bodyChanged,
                'base_uri' => self::BASE_URI
            ]);

        $this->assertResponseIsSuccessful();

        $content = json_decode($response->getContent(), true);

        assertEquals($this->bodyChanged['name'], $content['name']);
        assertEquals($this->bodyChanged['description'], $content['description']);
        assertEquals($this->bodyChanged['companyId'], $content['companyId']);
        assertEquals($this->bodyChanged['vatNumber'], $content['vatNumber']);
        assertEquals($this->bodyChanged['street'], $content['street']);
        assertEquals($this->bodyChanged['city'], $content['city']);
        assertEquals($this->bodyChanged['zipCode'], $content['zipCode']);
        assertEquals($this->bodyChanged['country'], $content['country']['id']);
    }

    /**
     * @param int $id
     * @return void
     * @throws TransportExceptionInterface
     * @depends testPost
     */
    public function testDelete(int $id): void
    {
        $response = $this->createClient()
            ->request('DELETE', self::URL . '/' . $id, [
                'base_uri' => self::BASE_URI
            ]);
        $this->assertResponseIsSuccessful();
        $this->assertEquals(204, $response->getStatusCode());
    }
}