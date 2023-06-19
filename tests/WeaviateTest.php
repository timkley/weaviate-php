<?php

namespace Tests;

use Weaviate\Api\Batch;
use Weaviate\Api\DataObject;
use Weaviate\Api\GraphQL;
use Weaviate\Api\Schema;

it('returns the schema api', function () {
    expect(weaviate()->schema())->toBeInstanceOf(Schema::class);
});

it('returns the objects api', function () {
    expect(weaviate()->dataObject())->toBeInstanceOf(DataObject::class);
});

it('returns the batch api', function () {
    expect(weaviate()->batch())->toBeInstanceOf(Batch::class);
});

it('returns the graphql api', function () {
    expect(weaviate()->graphql())->toBeInstanceOf(GraphQL::class);
});
