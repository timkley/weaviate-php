<?php

namespace Tests\Api;

use Weaviate\Api\Endpoint;

it('can add query parameters', function () {
    fakeResponse();

    $endpoint = new Endpoint(weaviate()->api);

    $response = $endpoint->withQueryParameters(['test' => 'value', 'filter' => 'another-value'])->request('test');

    expect($response->transferStats->getRequest()->getUri()->getQuery())->toBe('test=value&filter=another-value');
});
