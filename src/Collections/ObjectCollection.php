<?php

namespace Weaviate\Collections;

use Illuminate\Support\Collection;
use Weaviate\Model\ObjectModel;

class ObjectCollection extends Collection
{
    /** @var Object[] */
    protected $items = [];

    public static function fromArray(array $items): self
    {
        return new self(array_map(fn ($item) => new ObjectModel($item), $items));
    }
}
