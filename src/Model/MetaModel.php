<?php

namespace Weaviate\Model;

use Weaviate\Collections\ModuleCollection;

class MetaModel extends Model
{
    private string $hostname;
    private string $version;
    private ?ModuleCollection $modules;

    public function __construct(array $data)
    {
        $this->hostname = $data['hostname'];
        $this->version = $data['version'];
        $this->modules = isset($data['modules']) ? ModuleCollection::fromArray($data['modules']) : null;
    }

    public function getHostname(): string
    {
        return $this->hostname;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function getModules(): ?ModuleCollection
    {
        return $this->modules;
    }
}
