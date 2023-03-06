<?php

namespace Tests\Model;

use Weaviate\Collections\PropertyCollection;
use Weaviate\Model\ObjectModel;

it('creates an object from data', function () {
    $fixture = getJsonFixture('object.json');

    $objectModel = new ObjectModel($fixture);

    expect($objectModel->getClass())->toBe('Category');
    expect($objectModel->getProperties())->toBeInstanceOf(PropertyCollection::class);
});
