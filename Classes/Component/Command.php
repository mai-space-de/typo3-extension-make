<?php

declare(strict_types = 1);

namespace Maispace\MaiMake\Component;

/**
 * Console command component.
 */
class Command extends AbstractComponent implements ServiceConfigurationComponentInterface
{
    protected string $commandName = '';
    protected string $description = '';
    protected bool $schedulable = false;

    public function getCommandName(): string
    {
        return $this->commandName;
    }

    public function getCommandNameProposal(string $extensionKey): string
    {
        $extensionPrefix = trim(str_replace('_', '-', $extensionKey), '-');
        $commandName = trim(
            str_replace(
                'command',
                '',
                mb_strtolower(preg_replace('/(?<=\\w)([A-Z])/', '-\\1', $this->name) ?? '', 'utf-8')
            ),
            '-'
        );

        return $extensionPrefix . ':' . $commandName;
    }

    public function setCommandName(string $commandName): self
    {
        $this->commandName = $commandName;

        return $this;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function setSchedulable(bool $schedulable): self
    {
        $this->schedulable = $schedulable;

        return $this;
    }

    public function __toString(): string
    {
        return $this->createFileContent(
            'Command.php',
            [
                'NAMESPACE'   => $this->getNamespace(),
                'NAME'        => $this->name,
                'DESCRIPTION' => str_replace('\'', '\\\'', $this->description),
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
                        'name'        => 'console.command',
                        'command'     => $this->commandName,
                        'description' => $this->description,
                        'schedulable' => $this->schedulable,
                    ],
                ],
            ],
        ];
    }
}
