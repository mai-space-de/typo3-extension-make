<?php

declare(strict_types = 1);

namespace Maispace\Make\Component;

/**
 * Upgrade wizard component.
 */
class UpgradeWizard extends AbstractComponent implements ServiceConfigurationComponentInterface
{
    protected string $identifier = '';
    protected string $title = '';

    public function getIdentifierProposalForWizard(string $extensionKey): string
    {
        // Convert extension key from snake_case to camelCase: my_extension -> myExtension
        $prefix = lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $extensionKey))));

        // Remove 'UpgradeWizard' suffix and combine with prefix in camelCase
        $name = str_replace('UpgradeWizard', '', $this->name);

        return $prefix . ucfirst(lcfirst($name));
    }

    public function setIdentifier(string $identifier): self
    {
        $this->identifier = $identifier;

        return $this;
    }

    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function __toString(): string
    {
        return $this->createFileContent(
            'UpgradeWizard.php',
            [
                'NAMESPACE'  => $this->getNamespace(),
                'NAME'       => $this->name,
                'IDENTIFIER' => $this->identifier,
                'TITLE'      => str_replace('\'', '\\\'', $this->title ?: $this->name),
            ]
        );
    }

    /** @return array<string, mixed> */
    public function getServiceConfiguration(): array
    {
        return [
            $this->getClassName() => [
                'tags' => [
                    [
                        'name' => 'typo3.upgrade_wizard',
                    ],
                ],
            ],
        ];
    }
}
