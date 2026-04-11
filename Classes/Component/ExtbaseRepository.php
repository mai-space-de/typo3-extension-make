<?php

declare(strict_types = 1);

namespace Maispace\MaiMake\Component;

/**
 * Extbase domain repository component.
 */
class ExtbaseRepository extends AbstractComponent
{
    public function __toString(): string
    {
        return $this->createFileContent(
            'Repository.php',
            [
                'NAMESPACE' => $this->getNamespace(),
                'NAME'      => $this->name,
            ]
        );
    }
}
