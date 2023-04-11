<?php

namespace Tests\Api;

use Weaviate\Model\ModuleModel;

it('creates a model from data', function () {
    $fixture = getJsonFixture('module.json');

    $moduleClass = new ModuleModel($fixture);

    expect($moduleClass->getKey())->toBe('generative-openai');
    expect($moduleClass->getName())->toBe('Generative Search - OpenAI');
    expect($moduleClass->getDocumentationHref())->toBe('https://beta.openai.com/docs/api-reference/completions');
});
