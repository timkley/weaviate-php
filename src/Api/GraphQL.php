<?php

namespace Weaviate\Api;

class GraphQL extends Endpoint
{
    public const ENDPOINT = 'v1/graphql';

    public function get(string $query): array
    {
        return $this->api->post(self::ENDPOINT, [
            'query' => $query,
        ])->json();
    }
}
