<?php

namespace App\Tests\api;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;

class TicketTypeApiTest extends ApiTestCase implements ApiTestInterface
{
    use ApiTestTrait;

    private const URL = '/api/ticket_types';
    private const BASE_URI = 'https://127.0.0.1:8000';

    private array $body = [
        'name' => 'Test Ticket Type',
        'abbreviation' => 'TTT',
        'isDisable' => false,
        'coefficientPrice' => 1,
        'coefficientTime' => 1,
    ];
    private array $bodyChanged = [
        'name' => 'ZZZTest Ticket TypeAAAA',
        'abbreviation' => 'ZTTTA',
        'isDisable' => true,
        'coefficientPrice' => 2,
        'coefficientTime' => 0.4,
    ];
}