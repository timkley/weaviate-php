<?php

namespace Weaviate\Api;

use Illuminate\Http\Client\Response;
use Weaviate\Collections\ObjectCollection;

class Batch extends Endpoint
{
    public const ENDPOINT = 'batch/objects';

    protected const OUTPUT_METHODS = [
        'minimal',
        'verbose',
    ];

    protected const DEFAULT_OUTPUT = 'minimal';

    public function create(array $objects): ObjectCollection
    {
        return new ObjectCollection(
            $this->api->post(self::ENDPOINT, [
                'objects' => $objects,
            ])->json()
        );
    }

    public function delete(string $className, array $where = [], ?string $output = self::DEFAULT_OUTPUT, bool $dryRun = false): Response
    {
        if (is_null($output)) {
            $output = self::DEFAULT_OUTPUT;
        }

        if (!in_array($output, self::OUTPUT_METHODS)) {
            throw new \InvalidArgumentException('Invalid output method');
        }

        return $this->api->delete(self::ENDPOINT, [
            'match' => [
                'class' => $className,
                'where' => $where,
            ],
            'output' => $output,
            'dryRun' => $dryRun,
        ]);
    }
}
