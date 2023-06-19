<?php

namespace Tests\Api;

use Weaviate\Model\PropertyModel;
use Weaviate\Model\SchemaModel;

it('can get the schema', function () {
    fakeJsonResponse('schema.json');

    $schema = weaviate()->schema()->get();

    expect($schema)->toBeInstanceOf(SchemaModel::class);
});

it('can get a specific schema class', function () {
    fakeJsonResponse('schema.json');

    $schema = weaviate()->schema()->get('Category');

    expect($schema)->toBeInstanceOf(SchemaModel::class);
});

it('can create a schema class', function () {
    fakeJsonResponse('dataClass.json');

    $schemaClass = weaviate()->schema()->createClass([
        'class' => 'Category',
        'description' => 'A category',
        'properties' => [
            [
                'name' => 'name',
                'dataType' => [
                    'dataType' => 'string',
                ],
            ],
        ],
    ]);

    expect($schemaClass)->toBeInstanceOf(SchemaModel::class);
});

it('can update a schema class', function () {
    fakeJsonResponse('dataClass.json');

    $schemaClass = weaviate()->schema()->update('Category', [
        'class' => 'Category',
        'description' => 'A category',
    ]);

    expect($schemaClass)->toBeInstanceOf(SchemaModel::class);
});

it('can add a property', function () {
    fakeJsonResponse('property.json');

    $schemaClass = weaviate()->schema()->addProperty('Category', [
        'name' => 'name',
        'dataType' => [
            'dataType' => 'string',
        ],
    ]);

    expect($schemaClass)->toBeInstanceOf(PropertyModel::class);
});

it('can delete a schema class', function () {
    fakeResponse();
    $response = weaviate()->schema()->deleteClass('Category');

    expect($response)->status()->toBe(200);
});

it('can delete all classes', function () {
    fakeResponse();
    $response = weaviate()->schema()->deleteAll();

    expect($response)->status()->toBe(200);
});
