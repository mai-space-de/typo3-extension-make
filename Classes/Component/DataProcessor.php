<?php

declare(strict_types = 1);

namespace Maispace\MaiMake\Component;

/**
 * TypoScript data processor component.
 */
class DataProcessor extends AbstractComponent
{
    public function __toString(): string
    {
        return $this->createFileContent(
            'DataProcessor.php',
            [
                'NAMESPACE' => $this->getNamespace(),
                'NAME'      => $this->name,
            ]
        );
    }
}
