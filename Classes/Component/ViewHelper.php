<?php

declare(strict_types = 1);

namespace Maispace\Make\Component;

/**
 * Fluid ViewHelper component.
 */
class ViewHelper extends AbstractComponent
{
    public function __toString(): string
    {
        return $this->createFileContent(
            'ViewHelper.php',
            [
                'NAMESPACE' => $this->getNamespace(),
                'NAME'      => $this->name,
            ]
        );
    }
}
