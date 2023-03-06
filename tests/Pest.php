<?php

use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\Request;
use Pest\TestSuite;
use PHPUnit\Framework\TestCase;
use Weaviate\Weaviate;

function this(): ?TestCase
{
    return TestSuite::getInstance()->test;
}

function weaviate(): Weaviate
{
    return this()->weaviate ??= new Weaviate('', 'test-token');
}

function httpClient(): Factory
{
    return weaviate()->api->httpClient;
}

function getJsonFixture(string $filename): array
{
    return json_decode(file_get_contents(__DIR__ . sprintf('/Fixtures/%s', $filename)), true);
}

function fakeResponse(array $body = []): array
{
    httpClient()->fake([
        '*' => httpClient()->response($body),
    ]);

    return $body;
}

function fakeJsonResponse(string $filename): array
{
    $fixture = getJsonFixture($filename);

    return fakeResponse($fixture);
}

function assertBodySent(array $fixture): void
{
    httpClient()->assertSent(function (Request $request) use ($fixture) {
        return $request->body() === json_encode($fixture);
    });
}
