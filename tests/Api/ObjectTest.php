<?php

namespace Tests\Api;

use Weaviate\Collections\ObjectCollection;
use Weaviate\Model\ObjectModel;

it('can get all data objects', function () {
    fakeJsonResponse('objects.json');

    $objects = weaviate()->dataObject()->get();

    expect($objects)->toBeInstanceOf(ObjectCollection::class);
});

it('can get a single object', function () {
    fakeJsonResponse('object.json');

    $object = weaviate()->dataObject()->getById('Category', '1234');

    expect($object)->toBeInstanceOf(ObjectModel::class);
});

it('can create an object', function () {
    fakeJsonResponse('object.json');

    $object = weaviate()->dataObject()->create([
        'class' => 'Category',
        'properties' => [
            'name' => 'Test',
        ],
    ]);

    expect($object)->toBeInstanceOf(ObjectModel::class);
});

it('can update an object', function () {
    fakeJsonResponse('object.json');

    $object = weaviate()->dataObject()->update('Category', 'id', [
        'class' => 'Category',
        'properties' => [
            'name' => 'Test',
        ],
    ]);

    expect($object)->toBeInstanceOf(ObjectModel::class);
});

it('can replace an object', function () {
    fakeJsonResponse('object.json');

    $object = weaviate()->dataObject()->replace('Category', 'id', [
        'class' => 'Category',
        'properties' => [
            'name' => 'Test',
        ],
    ]);

    expect($object)->toBeInstanceOf(ObjectModel::class);
});

it('can delete an object', function () {
    fakeResponse();

    $response = weaviate()->dataObject()->delete('Category', 'id');

    expect($response)->status()->toBe(200);
});

it('can check if an object exists', function () {
    fakeJsonResponse('object.json');

    $response = weaviate()->dataObject()->exists('Category', 'id');

    expect($response->status())->toBe(200);
});
