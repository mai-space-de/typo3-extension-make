<?php

declare(strict_types = 1);

namespace Maispace\Make\Component;

/**
 * Extbase validator component.
 */
class Validator extends AbstractComponent
{
    public function __toString(): string
    {
        return $this->createFileContent(
            'Validator.php',
            [
                'NAMESPACE' => $this->getNamespace(),
                'NAME'      => $this->name,
            ]
        );
    }
}
