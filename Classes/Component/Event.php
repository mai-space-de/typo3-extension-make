<?php

declare(strict_types = 1);

namespace Maispace\MaiMake\Component;

/**
 * PSR-14 event component.
 */
class Event extends AbstractComponent
{
    public function __toString(): string
    {
        return $this->createFileContent(
            'Event.php',
            [
                'NAMESPACE' => $this->getNamespace(),
                'NAME'      => $this->name,
            ]
        );
    }
}
