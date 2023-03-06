<?php

namespace Weaviate\Collections;

use Illuminate\Support\Collection;

class PropertyCollection extends Collection
{
    public static function fromArray(array $items): self
    {
        return new self($items);
    }
}
