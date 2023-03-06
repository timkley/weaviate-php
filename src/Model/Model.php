<?php

namespace Weaviate\Model;

use Illuminate\Contracts\Support\Arrayable;
use ReflectionClass;

class Model implements Arrayable
{
    public function toArray(): array
    {
        $reflection = new ReflectionClass($this);
        $properties = $reflection->getProperties();
        $array = [];
        foreach ($properties as $property) {
            $property->setAccessible(true);
            $value = $property->getValue($this);
            $array[$property->getName()] = ($value instanceof Arrayable) ? $property->getValue($this)->toArray() : $value;
        }

        return $array;
    }
}
