<?php

namespace Tests\Api;

use Weaviate\Collections\ObjectCollection;
use Weaviate\Model\ObjectModel;

it('can get all data objects', function () {
    fakeJsonResponse('objects.json');

    $objects = weaviate()->objects()->get();

    expect($objects)->toBeInstanceOf(ObjectCollection::class);
});

it('can get a single object', function () {
    fakeJsonResponse('object.json');

    $object = weaviate()->objects()->getObject('Category', '1234');

    expect($object)->toBeInstanceOf(ObjectModel::class);
});

it('can create an object', function () {
    fakeJsonResponse('object.json');

    $object = weaviate()->objects()->create([
        'class' => 'Category',
        'properties' => [
            'name' => 'Test',
        ],
    ]);

    expect($object)->toBeInstanceOf(ObjectModel::class);
});
