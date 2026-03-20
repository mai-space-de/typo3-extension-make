<?php

declare(strict_types = 1);

namespace Maispace\MaiMake\IO;

/**
 * Interface for configuration classes performing IO operations.
 */
interface ConfigurationInterface
{
    /** @return array<string, mixed> */
    public function getConfiguration(): array;

    /** @param array<string, mixed> $configuration */
    public function setConfiguration(array $configuration): self;
    public function write(): bool;
}
