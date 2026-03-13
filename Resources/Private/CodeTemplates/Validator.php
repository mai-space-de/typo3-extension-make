<?php

declare(strict_types=1);

namespace {{NAMESPACE}};

use TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator;

class {{NAME}} extends AbstractValidator
{
    protected function isValid(mixed $value): void
    {
        // Add validation logic here
        // Use $this->addError('message', 1234567890) to add errors
    }
}
