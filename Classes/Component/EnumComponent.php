<?php

declare(strict_types = 1);

namespace Maispace\Make\Component;

/**
 * PHP enum component.
 */
class EnumComponent extends AbstractComponent
{
    protected string $backingType = 'string';

    public function setBackingType(string $backingType): self
    {
        $this->backingType = $backingType;

        return $this;
    }

    public function getBackingType(): string
    {
        return $this->backingType;
    }

    public function __toString(): string
    {
        return $this->createFileContent(
            'Enum.php',
            [
                'NAMESPACE' => $this->getNamespace(),
                'NAME'      => $this->name,
                'BACKING'   => $this->backingType !== '' ? ': ' . $this->backingType : '',
            ]
        );
    }
}
