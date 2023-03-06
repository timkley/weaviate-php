<?php

namespace Weaviate\Collections;

use Illuminate\Support\Collection;
use Weaviate\Model\ClassModel;

class ClassCollection extends Collection
{
    /** @var ClassModel[] */
    protected $items = [];

    public static function fromArray(array $items): self
    {
        return new self(array_map(fn ($item) => new ClassModel($item), $items));
    }
}
