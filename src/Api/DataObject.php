<?php

namespace Weaviate\Api;

use Illuminate\Http\Client\Response;
use Weaviate\Collections\ObjectCollection;
use Weaviate\Model\ObjectModel;

class DataObject extends Endpoint
{
    public const ENDPOINT = 'objects';

    public function get(): ObjectCollection
    {
        return new ObjectCollection(
            $this->api->get(self::ENDPOINT)->json()
        );
    }

    public function getById(string $className, string $id): Object
    {
        return new ObjectModel(
            $this->api->get(self::ENDPOINT . '/' . $className . '/' . $id)->json()
        );
    }

    public function create(array $data): ObjectModel
    {
        return new ObjectModel(
            $this->api->post(self::ENDPOINT, $data)->json()
        );
    }

    public function update(string $className, string $id, array $data, bool $replace = false): ObjectModel
    {
        if ($replace) {
            $response = $this->api->put(self::ENDPOINT . '/' . $className . '/' . $id, $data);
            $responseData = $response->json();
        } else {
            $response = $this->api->patch(self::ENDPOINT . '/' . $className . '/' . $id, $data);
            // workaround, no data is available in PATCH response
            $responseData = [
                'class' => $className,
                'id' => $id,
                'vector' => $data['vector'] ?? null,
                'properties' => $data['properties'] ?? null,
                'creationTimeUnix' => now()->timestamp, // workaround, field not available in PATCH response
                'lastUpdateTimeUnix' => now()->timestamp, // workaround, field not available in PATCH response
            ];
        }
        return new ObjectModel($responseData);
    }
    
    public function replace(string $className, string $id, array $data): ObjectModel
    {
        return $this->update($className, $id, $data, true);
    }

    public function delete(string $className, string $id): Response
    {
        return $this->api->delete(self::ENDPOINT . '/' . $className . '/' . $id);
    }

    public function exists(string $className, string $id): Response
    {
        return $this->api->head(self::ENDPOINT . '/' . $className . '/' . $id);
    }
}
