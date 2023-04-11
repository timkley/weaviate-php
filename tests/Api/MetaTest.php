<?php

namespace Tests\Api;

use Weaviate\Model\MetaModel;

it('can get meta information', function () {
    fakeJsonResponse('meta.json');

    $schema = weaviate()->meta()->get();

    expect($schema)->toBeInstanceOf(MetaModel::class);
});
