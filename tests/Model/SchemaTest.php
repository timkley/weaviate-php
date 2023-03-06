<?php

namespace Tests\Model;

use Weaviate\Collections\ClassCollection;
use Weaviate\Model\SchemaModel;

it('creates a model from data', function () {
    $fixture = getJsonFixture('schema.json');

    $schemaClass = new SchemaModel($fixture);

    expect($schemaClass->getClasses())->toBeInstanceOf(ClassCollection::class);
});
