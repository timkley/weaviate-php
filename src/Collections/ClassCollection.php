<?php

namespace Weaviate\Collections;

use Weaviate\Model\ClassModel;
use Illuminate\Support\Collection;

class ClassCollection extends Collection
{
    /** @var ClassModel[] */
    protected $items = [];

    public static function fromArray(array $items): self
    {
        return new self(array_map(fn ($item) => new ClassModel($item), $items));
    }
}
