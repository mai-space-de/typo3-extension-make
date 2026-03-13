<?php

declare(strict_types = 1);

namespace Maispace\Make\Component;

/**
 * Factory component.
 */
class Factory extends AbstractComponent
{
    public function __toString(): string
    {
        return $this->createFileContent(
            'Factory.php',
            [
                'NAMESPACE' => $this->getNamespace(),
                'NAME'      => $this->name,
            ]
        );
    }
}
