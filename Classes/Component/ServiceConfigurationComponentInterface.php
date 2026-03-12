<?php

declare(strict_types = 1);

namespace Maispace\Make\Component;

/**
 * Interface for components that produce a service configuration (Services.yaml)
 */
interface ServiceConfigurationComponentInterface
{
    public function getClassName(): string;

    /** @return array<string, mixed> */
    public function getServiceConfiguration(): array;
}
