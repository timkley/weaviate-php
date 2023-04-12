<?php

namespace Tests;

beforeEach(function () {
    fakeResponse();
});

it('can make a request with different methods', function (string $method) {
    $response = weaviate()->api->{$method}('test');

    expect($response->transferStats->getRequest()->getMethod())->toBe(strtoupper($method));
})->with([
    'get',
    'post',
    'put',
    'patch',
    'delete',
]);

it('accepts query parameters', function () {
    weaviate()->api->setQueryParameters(['test' => 'value', 'filter' => 'another-value']);

    expect(weaviate()->api->getQueryParameters())->toBe(['test' => 'value', 'filter' => 'another-value']);
});
