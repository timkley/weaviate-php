<?php

namespace Weaviate;

use Weaviate\Api\Batch;
use Weaviate\Api\GraphQL;
use Weaviate\Api\Objects;
use Weaviate\Api\Schema;

class Weaviate
{
    public Api $api;

    private Schema $schema;
    private Objects $objects;
    private Batch $batch;
    private GraphQL $graphQL;

    public function __construct(string $apiUrl, string $apiToken, array $additionalHeaders = [])
    {
        $this->api = new Api($apiUrl, $apiToken, $additionalHeaders);
    }

    public function schema(): Schema
    {
        return $this->schema ??= new Schema($this->api);
    }

    public function objects(): Objects
    {
        return $this->objects ??= new Objects($this->api);
    }

    public function batch(): Batch
    {
        return $this->batch ??= new Batch($this->api);
    }

    public function graphql(): GraphQL
    {
        return $this->graphQL ??= new GraphQL($this->api);
    }
}
