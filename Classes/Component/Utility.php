<?php

declare(strict_types = 1);

namespace Maispace\Make\Component;

/**
 * Utility component.
 */
class Utility extends AbstractComponent
{
    public function __toString(): string
    {
        return $this->createFileContent(
            'Utility.php',
            [
                'NAMESPACE' => $this->getNamespace(),
                'NAME'      => $this->name,
            ]
        );
    }
}
