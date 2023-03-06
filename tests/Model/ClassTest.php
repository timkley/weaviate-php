<?php

namespace Tests\Model;

use Weaviate\Collections\PropertyCollection;
use Weaviate\Model\ClassModel;

it('creates a model from data', function () {
    $fixture = getJsonFixture('dataClass.json');

    $dataClass = new ClassModel($fixture);

    expect($dataClass)->toBeInstanceOf(ClassModel::class)
        ->and($dataClass->getClass())->toBe('Category')
        ->and($dataClass->getDescription())->toBe('Category an article is a type off')
        ->and($dataClass->getVectorizer())->toBe('none')
        ->and($dataClass->getProperties())->toBeInstanceOf(PropertyCollection::class)
        ->and($dataClass->getModuleConfig())->toBeArray()
    ;
});
