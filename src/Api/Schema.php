<?php

namespace Weaviate\Api;

use Illuminate\Http\Client\Response;
use Weaviate\Model\PropertyModel;
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

    public function update(string $className, array $data): SchemaModel
    {
        return new SchemaModel(
            $this->api->put(self::ENDPOINT . '/' . $className, $data)->json()
        );
    }

    public function addProperty(string $className, array $data): PropertyModel
    {
        return new PropertyModel(
            $this->api->put(self::ENDPOINT . '/' . $className, $data)->json()
        );
    }

    public function delete(string $className): Response
    {
        return $this->api->delete(self::ENDPOINT . '/' . $className);
    }
}
