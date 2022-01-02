<?php

namespace App\Tests\api;

interface ApiTestInterface
{
    function testGetAll(): void;
    function testPost(): int;
    function testGetItem(int $id): void;
    function testPut(int $id): void;
    function testDelete(int $id): void;
}