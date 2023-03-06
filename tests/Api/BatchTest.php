<?php

namespace Tests\Api;

use Weaviate\Collections\ObjectCollection;

it('can create objects in batch', function () {
    fakeJsonResponse('objects.json');

    $objects = weaviate()->batch()->create([]);

    expect($objects)->toBeInstanceOf(ObjectCollection::class);
});

it('can delete objects in batch', function () {
    fakeJsonResponse('objects.json');

    $response = weaviate()->batch()->delete('where x is y');

    expect($response->status())->toBe(200);
});
