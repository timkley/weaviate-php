<?php

namespace Weaviate\Api;

use Weaviate\Model\SchemaModel as SchemaModel;

class Schema extends Endpoint
{
    public const ENDPOINT = 'schema';

    public function get(): SchemaModel
    {
        return new SchemaModel(
            $this->api->get(self::ENDPOINT)->json()
        );
    }

    public function getClass(string $className): SchemaModel
    {
        return new SchemaModel(
            $this->api->get(self::ENDPOINT . '/' . $className)->json()
        );
    }

    public function create(array $data): SchemaModel
    {
        return new SchemaModel(
            $this->api->post(self::ENDPOINT, $data)->json()
        );
    }
}
