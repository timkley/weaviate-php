<?php

namespace Weaviate\Model;

use Weaviate\Collections\PropertyCollection;

class ClassModel extends Model
{
    private string $class;
    private string $description;
    private string $vectorizer;
    private ?PropertyCollection $properties;
    private ?array $moduleConfig;

    public function __construct(array $data)
    {
        $this->class = $data['class'];
        $this->description = $data['description'] ?? '';
        $this->vectorizer = $data['vectorizer'];
        $this->properties = isset($data['properties']) ? PropertyCollection::fromArray($data['properties']) : null;
        $this->moduleConfig = $data['moduleConfig'] ?? null;
    }

    public function getClass(): string
    {
        return $this->class;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getVectorizer(): string
    {
        return $this->vectorizer;
    }

    public function getProperties(): ?PropertyCollection
    {
        return $this->properties;
    }

    public function getModuleConfig(): ?array
    {
        return $this->moduleConfig;
    }
}
