<?php

namespace Weaviate\Api;

use Illuminate\Http\Client\Response;
use Weaviate\Api;

class Endpoint
{
    public function __construct(protected Api $api)
    {
    }

    public function withQueryParameters(array $queryParameters): static
    {
        $this->api->setQueryParameters($queryParameters);

        return $this;
    }

    public function request(string $url, string $method = 'get', array $data = []): Response
    {
        return $this->api->{$method}($url, $data);
    }
}
