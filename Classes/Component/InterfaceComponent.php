<?php

declare(strict_types = 1);

namespace Maispace\Make\Component;

/**
 * PHP interface component.
 */
class InterfaceComponent extends AbstractComponent
{
    public function __toString(): string
    {
        return $this->createFileContent(
            'Interface.php',
            [
                'NAMESPACE' => $this->getNamespace(),
                'NAME'      => $this->name,
            ]
        );
    }
}
