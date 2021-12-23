<?php

namespace App\Tests\api;

use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

trait ApiTestTrait
{
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
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
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

    /**
     * Compare defined test values and 3check response from API
     * @param array $body
     * @param array $content
     * @return void
     */
    public function checkResponse(array $body, array $content)
    {
        foreach (array_keys($body) as $key) {
            if (is_array($content[$key])) {
                $this->assertEquals($body[$key], $content[$key]['id']);
            } else {
                $this->assertEquals($body[$key], $content[$key]);
            }
        }
    }
}