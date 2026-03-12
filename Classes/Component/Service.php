<?php

declare(strict_types = 1);

namespace Maispace\Make\Component;

/**
 * Service component.
 */
class Service extends AbstractComponent
{
    public function __toString(): string
    {
        return $this->createFileContent(
            'Service.php',
            [
                'NAMESPACE' => $this->getNamespace(),
                'NAME'      => $this->name,
            ]
        );
    }
}
