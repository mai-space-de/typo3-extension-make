<?php

declare(strict_types = 1);

namespace Maispace\Make\IO;

/**
 * Abstract for configuration classes, performing IO operations.
 */
abstract class AbstractConfiguration implements ConfigurationInterface
{
    protected string $packagePath = '';

    /** @var array<string, mixed> */
    protected array $configuration = [];

    public function __construct(string $packagePath)
    {
        $this->packagePath = rtrim($packagePath, '/') . '/';
        $this->configuration = $this->load();
    }

    /** @return array<string, mixed> */
    abstract protected function load(): array;

    /** @return array<string, mixed> */
    public function getConfiguration(): array
    {
        return $this->configuration;
    }

    /** @param array<string, mixed> $configuration */
    public function setConfiguration(array $configuration): ConfigurationInterface
    {
        $this->configuration = $configuration;

        return $this;
    }
}
