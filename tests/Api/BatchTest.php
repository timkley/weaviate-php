<?php

namespace Tests\Api;

use Weaviate\Collections\ObjectCollection;

it('can create objects in batch', function () {
    fakeJsonResponse('objects.json');

    $objects = weaviate()->batch()->create([]);

    expect($objects)->toBeInstanceOf(ObjectCollection::class);
});

it('can delete objects in batch', function (?string $outputMethod) {
    fakeJsonResponse('objects.json');

    $response = weaviate()->batch()->delete('Category', ['path'], $outputMethod);

    expect($response->status())->toBe(200);
})->with([
    'minimal',
    'verbose',
    null,
]);

it('throws an exception when using an unsupported output method', function () {
    fakeJsonResponse('objects.json');

    $object = weaviate()->batch()->delete('Category', [], 'invalid');
})->expectException(\InvalidArgumentException::class);
