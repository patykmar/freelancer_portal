<?php

namespace App\Tests\api;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;

class InvoiceApiTest extends ApiTestCase implements ApiTestInterface
{
    use ApiTestTrait {
        checkResponse as protected traitCheckResponse;
    }

    private const URL = '/api/invoices';
    private const BASE_URI = 'https://127.0.0.1:8000';

    private array $body = [
        'supplier' => 1,
        'subscriber' => 4,
        'paymentType' => 1,
        'due' => 14,
        'userCreated' => 1,
        "invoiceItems" => [
            [
                "vat" => 1,
                "name" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
                "price" => 772653,
                "margin" => 251,
                "discount" => 70,
                "unitCount" => 8741.4,
            ],
            [
                "vat" => 1,
                "name" => " 2 Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
                "price" => 123400,
                "margin" => 50,
                "discount" => 0,
                "unitCount" => 333.4,
            ]
        ],
    ];
    private array $bodyChanged = [
        'supplier' => 2,
        'subscriber' => 3,
        'paymentType' => 2,
        'due' => 10,
        'paymentDate' => 1633910400,
        'userCreated' => 2,
        "invoiceItems" => [
            [
                "vat" => 1,
                "name" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
                "price" => 772653,
                "margin" => 251,
                "discount" => 70,
                "unitCount" => 8741.4,
            ],
            [
                "vat" => 1,
                "name" => " 2 Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
                "price" => 123400,
                "margin" => 50,
                "discount" => 0,
                "unitCount" => 333.4,
            ]
        ],
    ];

    /**
     * Split checking invoice and invoice items as separate tread
     * @param array $body
     * @param array $content
     */
    public function checkResponse(array $body, array $content)
    {
        if (is_array($body['invoiceItems'])) {
            $invoiceItems = $body['invoiceItems'];
            unset($body['invoiceItems']);

            $this->traitCheckResponse($body, $content);
            $this->checkResponseInvoiceItems($invoiceItems, $content);
        }
    }

    /**
     * @param array $invoiceItems
     * @param array $content
     * @return void
     */
    private function checkResponseInvoiceItems(array $invoiceItems, array $content)
    {
        $this->assertNotEmpty($content['invoiceItems']);
        for ($i = 0; $i < count($invoiceItems); $i++) {
            $this->traitCheckResponse($invoiceItems[$i], $content['invoiceItems'][$i]);
        }
    }
}