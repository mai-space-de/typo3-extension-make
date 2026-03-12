<?php

declare(strict_types = 1);

namespace Maispace\Make\Component;

/**
 * PHP trait component
 */
class TraitComponent extends AbstractComponent
{
    public function __toString(): string
    {
        return $this->createFileContent(
            'Trait.php',
            [
                'NAMESPACE' => $this->getNamespace(),
                'NAME'      => $this->name,
            ]
        );
    }
}
