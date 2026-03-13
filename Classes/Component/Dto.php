<?php

declare(strict_types = 1);

namespace Maispace\Make\Component;

/**
 * Data Transfer Object component.
 */
class Dto extends AbstractComponent
{
    public function __toString(): string
    {
        return $this->createFileContent(
            'Dto.php',
            [
                'NAMESPACE' => $this->getNamespace(),
                'NAME'      => $this->name,
            ]
        );
    }
}
