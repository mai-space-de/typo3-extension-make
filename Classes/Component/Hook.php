<?php

declare(strict_types = 1);

namespace Maispace\MaiMake\Component;

/**
 * Hook component.
 */
class Hook extends AbstractComponent
{
    public function __toString(): string
    {
        return $this->createFileContent(
            'Hook.php',
            [
                'NAMESPACE' => $this->getNamespace(),
                'NAME'      => $this->name,
            ]
        );
    }
}
