<?php

declare(strict_types=1);

namespace Maispace\Make\IO;

/**
 * Interface for configuration classes performing IO operations
 */
interface ConfigurationInterface
{
    public function getConfiguration(): array;
    public function setConfiguration(array $configuration): self;
    public function write(): bool;
}
