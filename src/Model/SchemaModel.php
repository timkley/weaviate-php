<?php

namespace Weaviate\Model;

use Weaviate\Collections\ClassCollection;

class SchemaModel extends Model
{
    private ?ClassCollection $classes;

    public function __construct(array $data)
    {
        $this->classes = isset($data['classes']) ? ClassCollection::fromArray($data['classes']) : null;
    }

    public function getClasses(): ?ClassCollection
    {
        return $this->classes;
    }
}
