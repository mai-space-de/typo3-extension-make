<?php

declare(strict_types=1);

namespace Maispace\Make\Component;

/**
 * Event listener component
 */
class EventListener extends AbstractComponent implements ServiceConfigurationComponentInterface
{
    protected string $identifier = '';
    protected string $eventName = '';
    protected string $methodName = '';

    public function getNameProposal(): string
    {
        $parts = explode('\\', ltrim($this->eventName, '\\'));

        return end($parts) . 'Listener';
    }

    public function setIdentifier(string $identifier): self
    {
        $this->identifier = $identifier;

        return $this;
    }

    public function getEventName(): string
    {
        return $this->eventName;
    }

    public function setEventName(string $eventName): self
    {
        $this->eventName = '\\' . ltrim(str_replace('/', '\\', $eventName), '\\');

        return $this;
    }

    public function setMethodName(string $methodName): self
    {
        $this->methodName = $methodName;

        return $this;
    }

    public function __toString(): string
    {
        return $this->createFileContent(
            'EventListener.php',
            [
                'NAMESPACE' => $this->getNamespace(),
                'NAME'      => $this->name,
                'METHOD'    => $this->methodName ?: '__invoke',
                'EVENT'     => $this->eventName,
            ]
        );
    }

    public function getServiceConfiguration(): array
    {
        $configuration = [
            $this->getClassName() => [
                'tags' => [
                    [
                        'name'       => 'event.listener',
                        'identifier' => $this->identifier,
                        'event'      => ltrim($this->eventName, '\\'),
                    ],
                ],
            ],
        ];
        if ($this->methodName !== '') {
            $configuration[$this->getClassName()]['tags'][0]['method'] = $this->methodName;
        }

        return $configuration;
    }
}
