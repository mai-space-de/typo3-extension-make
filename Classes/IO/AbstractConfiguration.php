<?php

declare(strict_types=1);

namespace Maispace\Make\IO;

/**
 * Abstract for configuration classes, performing IO operations
 */
abstract class AbstractConfiguration implements ConfigurationInterface
{
    protected string $packagePath = '';
    protected array $configuration = [];

    public function __construct(string $packagePath)
    {
        $this->packagePath = rtrim($packagePath, '/') . '/';
        $this->configuration = $this->load();
    }

    abstract protected function load(): array;

    public function getConfiguration(): array
    {
        return $this->configuration;
    }

    public function setConfiguration(array $configuration): ConfigurationInterface
    {
        $this->configuration = $configuration;

        return $this;
    }
}
