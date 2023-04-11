<?php

namespace Weaviate\Api;

use Weaviate\Model\MetaModel;

class Meta extends Endpoint
{
    public const ENDPOINT = 'meta';

    public function get(): MetaModel
    {
        return new MetaModel(
            $this->api->get(self::ENDPOINT)->json()
        );
    }
}
