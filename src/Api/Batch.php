<?php

namespace Weaviate\Api;

use Illuminate\Http\Client\Response;
use Weaviate\Collections\ObjectCollection;

class Batch extends Endpoint
{
    public const ENDPOINT = 'batch/objects';

    public function create(array $objects): ObjectCollection
    {
        return new ObjectCollection(
            $this->api->post(self::ENDPOINT, [
                'objects' => $objects,
            ])->json()
        );
    }

    public function delete(string $className, array $where = []): Response
    {
        return $this->api->delete(self::ENDPOINT, [
            'match' => [
                'class' => $className,
                'where' => $where,
            ],
        ]);
    }
}
