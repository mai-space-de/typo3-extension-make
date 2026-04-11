<?php

declare(strict_types = 1);

namespace Maispace\MaiMake\Component;

/**
 * Custom route enhancer component.
 */
class RouteEnhancer extends AbstractComponent
{
    public function __toString(): string
    {
        return $this->createFileContent(
            'RouteEnhancer.php',
            [
                'NAMESPACE' => $this->getNamespace(),
                'NAME'      => $this->name,
            ]
        );
    }
}
