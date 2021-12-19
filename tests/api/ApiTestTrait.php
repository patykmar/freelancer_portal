<?php

namespace App\Tests\api;

trait ApiTestTrait
{
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