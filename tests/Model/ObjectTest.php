<?php

namespace Tests\Model;

use Weaviate\Collections\PropertyCollection;
use Weaviate\Model\ObjectModel;

it('creates an object from data', function () {
    $fixture = getJsonFixture('object.json');

    $objectModel = new ObjectModel($fixture);

    expect($objectModel->getId())->toBe('02c0906d-fd93-4159-a711-47ceb585925f');
    expect($objectModel->getClass())->toBe('Category');
    expect($objectModel->getProperties())->toBeInstanceOf(PropertyCollection::class);
});
