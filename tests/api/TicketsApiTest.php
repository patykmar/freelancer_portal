<?php

namespace App\Tests\api;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;

class TicketsApiTest extends ApiTestCase implements ApiTestInterface
{
    use ApiTestTrait;

    private const URL = '/api/tickets';
    private const BASE_URI = 'https://127.0.0.1:8000';

    private array $body = [
        'serviceCatalog' => 21,
        'ci' => 11,
        'queueUser' => 5,
        'userCreated' => 3,
        'ticketState' => 11,
        'ticketType' => 1,
        'priority' => 3,
        'impact' => 1,
        'descriptionTitle' => "Morbi et risus sed enim consequat auctor id convallis massa.",
        'descriptionBody' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
    ];
    private array $bodyChanged = [
        'serviceCatalog' => 21,
        'userCreated' => 4,
        'ticketState' => 11,
        'ticketType' => 3,
        'priority' => 1,
        'impact' => 1,
        'queueUser' => 5,
        'descriptionTitle' => "AAAAA changed - auctor id convallis massa.",
        'descriptionBody' => "ZZZZZZ changed - Lorem ipsum dolor sit amet",
        'ci' => 11,
    ];
}