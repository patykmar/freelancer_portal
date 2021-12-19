<?php

namespace App\Tests\api;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;

class CountryTestApi extends ApiTestCase implements ApiTestInterface
{
    use ApiTestTrait;

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
}