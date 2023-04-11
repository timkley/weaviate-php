<?php

namespace Weaviate\Collections;

use Illuminate\Support\Collection;
use Weaviate\Model\ModuleModel;

class ModuleCollection extends Collection
{
    /** @var ModuleModel[] */
    protected $items = [];

    public static function fromArray(array $items): self
    {
        return new self(array_map(fn ($key, $item) => new ModuleModel([$key => $item]), array_keys($items), $items));
    }
}
