<?php

namespace Weaviate\Model;

class PropertyModel extends Model
{
    private string $name;
    private string $description;
    private array $dataType;
    private ?array $moduleConfig;

    public function __construct(array $data)
    {
        $this->name = $data['name'];
        $this->description = $data['description'] ?? '';
        $this->dataType = $data['dataType'];
        $this->moduleConfig = $data['moduleConfig'] ?? null;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getDataType(): array
    {
        return $this->dataType;
    }

    public function getModuleConfig(): ?array
    {
        return $this->moduleConfig;
    }
}
