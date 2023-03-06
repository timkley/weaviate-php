<?php

namespace Weaviate\Model;

use Weaviate\Collections\PropertyCollection;

class ObjectModel extends Model
{
    private string $class;
    private ?PropertyCollection $properties;
    private ?array $vector;
    private int $creationTimeUnix;
    private int $lastUpdateTimeUnix;

    public function __construct(array $data)
    {
        $this->class = $data['class'];
        $this->properties = isset($data['properties']) ? PropertyCollection::fromArray($data['properties']) : null;
        $this->vector = $data['vector'] ?? null;
        $this->creationTimeUnix = $data['creationTimeUnix'];
        $this->lastUpdateTimeUnix = $data['lastUpdateTimeUnix'];
    }

    public function getClass(): string
    {
        return $this->class;
    }

    public function getProperties(): ?PropertyCollection
    {
        return $this->properties;
    }

    public function getVector(): ?array
    {
        return $this->vector;
    }

    public function getCreationTimeUnix(): int
    {
        return $this->creationTimeUnix;
    }

    public function getLastUpdateTimeUnix(): int
    {
        return $this->lastUpdateTimeUnix;
    }
}
