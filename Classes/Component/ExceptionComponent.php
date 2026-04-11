<?php

declare(strict_types = 1);

namespace Maispace\MaiMake\Component;

/**
 * Exception component (generates a PHP exception class).
 */
class ExceptionComponent extends AbstractComponent
{
    protected string $parentClass = '\\RuntimeException';

    public function setParentClass(string $parentClass): self
    {
        $this->parentClass = '\\' . ltrim(str_replace('/', '\\', $parentClass), '\\');

        return $this;
    }

    public function getParentClass(): string
    {
        return $this->parentClass;
    }

    public function __toString(): string
    {
        return $this->createFileContent(
            'Exception.php',
            [
                'NAMESPACE'    => $this->getNamespace(),
                'NAME'         => $this->name,
                'PARENT_CLASS' => $this->parentClass,
            ]
        );
    }
}
