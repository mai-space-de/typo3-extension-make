<?php

declare(strict_types = 1);

namespace Maispace\MaiMake\Component;

/**
 * Extbase property type converter component.
 */
class TypeConverter extends AbstractComponent
{
    public function __toString(): string
    {
        return $this->createFileContent(
            'TypeConverter.php',
            [
                'NAMESPACE' => $this->getNamespace(),
                'NAME'      => $this->name,
            ]
        );
    }
}
