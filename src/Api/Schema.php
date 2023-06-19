<?php

namespace Weaviate\Api;

use Illuminate\Http\Client\Response;
use Weaviate\Model\PropertyModel;
use Weaviate\Model\SchemaModel as SchemaModel;

class Schema extends Endpoint
{
    public const ENDPOINT = 'schema';

    public function get(?string $className = null): SchemaModel
    {
        $url = $className ? self::ENDPOINT . "/{$className}" : self::ENDPOINT;

        return new SchemaModel(
            $this->api->get($url)->json()
        );
    }

    public function createClass(array $data): SchemaModel
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
            $this->api->post(self::ENDPOINT . '/' . $className . '/properties', $data)->json()
        );
    }

    public function deleteClass(string $className): Response
    {
        return $this->api->delete(self::ENDPOINT . '/' . $className);
    }

    public function deleteAll(): Response
    {
        return $this->api->delete(self::ENDPOINT);
    }
}
