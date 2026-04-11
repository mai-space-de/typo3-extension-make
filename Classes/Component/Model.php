<?php

declare(strict_types = 1);

namespace Maispace\MaiMake\Component;

/**
 * Extbase domain model component.
 */
class Model extends AbstractComponent
{
    public function __toString(): string
    {
        return $this->createFileContent(
            'Model.php',
            [
                'NAMESPACE' => $this->getNamespace(),
                'NAME'      => $this->name,
            ]
        );
    }
}
