<?php

declare(strict_types=1);

namespace Maispace\Make\Environment;

/**
 * Check and access environment variables
 */
class Variables
{
    private const ENV_PREFIX = 'MAKE_';

    public static function has(string $name, bool $allowEmpty = false): bool
    {
        $value = $_ENV[self::ENV_PREFIX . $name] ?? getenv(self::ENV_PREFIX . $name);

        return $allowEmpty ? is_string($value) : (bool)$value;
    }

    public static function get(string $name): string
    {
        return $_ENV[self::ENV_PREFIX . $name] ?? getenv(self::ENV_PREFIX . $name) ?: '';
    }
}
