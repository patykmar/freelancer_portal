<?php

namespace App\Tests\api;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class CiApiTest extends ApiTestCase implements ApiTestInterface
{
    use ApiTestTrait;

    private const URL = '/api/cis';
    private const BASE_URI = 'https://127.0.0.1:8000';

    private array $body = [
        "parentCi" => 1,
        "createdUser" => 1,
        "state" => 1,
        "tariff" => 1,
        "company" => 1,
        "queueTier1" => 1,
        "queueTier2" => 2,
        "queueTier3" => 2,
        "name" => "Test name of CI",
        "description" => "Suspendisse ac nisi laoreet, vulputate augue eget, porttitor arcu."
    ];
    private array $bodyChanged = [
        "parentCi" => 2,
        "createdUser" => 2,
        "state" => 2,
        "tariff" => 2,
        "company" => 2,
        "queueTier1" => 2,
        "queueTier2" => 1,
        "queueTier3" => 1,
        "name" => "Test name of CI AAAAAA",
        "description" => "Suspendisse ac"
    ];


    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    function testGetAll(): void
    {
        $content = self::createClient()
            ->request('GET', self::URL)
            ->getContent();
        $jsonData = json_decode($content, true);
        $this->assertNotEmpty($jsonData['hydra:member']);
    }

    /**
     * @return int
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    function testPost(): int
    {
        $response = $this->createClient()
            ->request("POST", self::URL, [
                'json' => $this->body,
                'base_uri' => self::BASE_URI
            ]);
        $this->assertResponseIsSuccessful();
        $content = json_decode($response->getContent(), true);

        $this->checkResponse($this->body, $content);

        return $content['id'];
    }

    /**
     * @param int $id
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     * @depends testPost
     */
    function testGetItem(int $id): void
    {
        $response = $this->createClient()
            ->request('GET', self::URL . '/' . $id, [
                'base_uri' => self::BASE_URI
            ]);

        $this->assertResponseIsSuccessful();

        $content = json_decode($response->getContent(), true);
        $this->checkResponse($this->body, $content);
    }

    /**
     * @param int $id
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     * @depends testPost
     */
    function testPut(int $id): void
    {
        $response = $this->createClient()
            ->request('PUT', self::URL . '/' . $id, [
                'json' => $this->bodyChanged,
                'base_uri' => self::BASE_URI
            ]);

        $this->assertResponseIsSuccessful();

        $content = json_decode($response->getContent(), true);
        $this->checkResponse($this->bodyChanged, $content);
    }

    /**
     * @throws TransportExceptionInterface
     * @depends testPost
     */
    function testDelete(int $id): void
    {
        $response = $this->createClient()
            ->request('DELETE', self::URL . '/' . $id, [
                'base_uri' => self::BASE_URI
            ]);
        $this->assertResponseIsSuccessful();
        $this->assertEquals(204, $response->getStatusCode());
    }
}