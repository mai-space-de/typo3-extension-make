<?php

declare(strict_types=1);

namespace {{NAMESPACE}};

use TYPO3\CMS\Core\Database\ConnectionPool;

/**
 * {{DESCRIPTION}}
 */
class {{NAME}}
{
    public function __construct(
        private readonly ConnectionPool $connectionPool,
    ) {}

    public function migrate(): void
    {
        // Perform data migration here
    }
}
