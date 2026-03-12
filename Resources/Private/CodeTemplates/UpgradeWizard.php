<?php

declare(strict_types=1);

namespace {{NAMESPACE}};

use TYPO3\CMS\Install\Attribute\UpgradeWizard;
use TYPO3\CMS\Install\Updates\UpgradeWizardInterface;

#[UpgradeWizard('{{IDENTIFIER}}')]
class {{NAME}} implements UpgradeWizardInterface
{
    public function getTitle(): string
    {
        return '{{TITLE}}';
    }

    public function getDescription(): string
    {
        return '';
    }

    public function executeUpdate(): bool
    {
        // Perform upgrade here
        return true;
    }

    public function updateNecessary(): bool
    {
        // Check if update is necessary
        return false;
    }

    public function getPrerequisites(): array
    {
        return [];
    }
}
