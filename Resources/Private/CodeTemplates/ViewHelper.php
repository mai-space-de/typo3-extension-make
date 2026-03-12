<?php

declare(strict_types=1);

namespace {{NAMESPACE}};

use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class {{NAME}} extends AbstractViewHelper
{
    public function initializeArguments(): void
    {
        // Add ViewHelper arguments here
        // $this->registerArgument('name', 'string', 'Description', true);
    }

    public static function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext,
    ): string {
        // Do awesome stuff
        return '';
    }
}
