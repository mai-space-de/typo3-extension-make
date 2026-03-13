<?php

declare(strict_types=1);

namespace {{NAMESPACE}};

use TYPO3\CMS\Core\Routing\Enhancer\EnhancerInterface;
use TYPO3\CMS\Core\Routing\RouteCollection;

class {{NAME}} implements EnhancerInterface
{
    public function __construct(protected readonly array $configuration = []) {}

    public function enhanceForMatching(RouteCollection $collection): void
    {
        // Add custom routes to the collection
    }

    public function enhanceForGeneration(RouteCollection $collection, array $originalParameters): void
    {
        // Enhance routes for URL generation
    }
}
