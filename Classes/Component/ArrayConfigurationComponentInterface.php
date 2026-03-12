<?php

declare(strict_types = 1);

namespace Maispace\Make\Component;

/**
 * Interface for components that produce an array configuration (e.g. RequestMiddlewares.php).
 */
interface ArrayConfigurationComponentInterface
{
    /** @return array<string, mixed> */
    public function getArrayConfiguration(): array;
}
