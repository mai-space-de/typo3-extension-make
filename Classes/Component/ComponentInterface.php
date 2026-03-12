<?php

declare(strict_types = 1);

namespace Maispace\Make\Component;

/**
 * Interface to be implemented by components
 */
interface ComponentInterface
{
    public function getName(): string;
    public function getDirectory(): string;
    public function getClassName(): string;

    public function __toString(): string;
}
