<?php

namespace Weaviate\Model;

class ModuleModel extends Model
{
    private string $key;
    private string $name;
    private string $documentationHref;

    public function __construct(array $data)
    {
        $this->key = (string) array_key_first($data);
        $data = $data[$this->key] ?? [];
        $this->name = $data['name'] ?? '';
        $this->documentationHref = $data['documentationHref'] ?? '';
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDocumentationHref(): string
    {
        return $this->documentationHref;
    }
}
