<?php

namespace App\Tests\api;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class CountryTestApi extends ApiTestCase implements ApiTestInterface
{
    private const URL = '/api/countries';
    private const BASE_URI = 'https://127.0.0.1:8000';

    private array $body = [
        "name" => "United Kingdom of Great Britain and Northern Ireland",
        "iso3166alpha3" => "GBR"
    ];

    private array $bodyChanged = [
        "name" => "Northern Kingdom of Great Britain and United  Ireland",
        "iso3166alpha3" => "GBR"
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
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     * @return int
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

        $this->assertEquals($this->body['name'], $content['name']);
        $this->assertEquals($this->body['iso3166alpha3'], $content['iso3166alpha3']);

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

        $this->assertEquals($this->body['name'], $content['name']);
        $this->assertEquals($this->body['iso3166alpha3'], $content['iso3166alpha3']);
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
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

        $this->assertEquals($this->bodyChanged['name'], $content['name']);
        $this->assertEquals($this->bodyChanged['iso3166alpha3'], $content['iso3166alpha3']);
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