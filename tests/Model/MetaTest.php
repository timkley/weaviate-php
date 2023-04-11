<?php

namespace Tests\Api;

use Weaviate\Collections\ModuleCollection;
use Weaviate\Model\MetaModel;

it('creates a model from data', function () {
    $fixture = getJsonFixture('meta.json');

    $metaClass = new MetaModel($fixture);

    expect($metaClass->getHostname())->toBe('http://[::]:8080');
    expect($metaClass->getVersion())->toBe('1.17.4');
    expect($metaClass->getModules())->toBeInstanceOf(ModuleCollection::class);
});
