<?php

declare(strict_types=1);

namespace Maispace\Make\Component;

/**
 * Middleware component
 */
class Middleware extends AbstractComponent implements ArrayConfigurationComponentInterface
{
    protected string $identifier = '';
    protected string $type = '';
    protected array $before = [];
    protected array $after = [];

    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    public function setIdentifier(string $identifier): self
    {
        $this->identifier = $identifier;

        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function setBefore(array $before): self
    {
        $this->before = $before;

        return $this;
    }

    public function setAfter(array $after): self
    {
        $this->after = $after;

        return $this;
    }

    public function __toString(): string
    {
        return $this->createFileContent(
            'Middleware.php',
            [
                'NAMESPACE' => $this->getNamespace(),
                'NAME'      => $this->name,
            ]
        );
    }

    public function getArrayConfiguration(): array
    {
        $configuration = [
            'target' => $this->getClassName(),
        ];

        if ($this->before !== []) {
            $configuration['before'] = $this->before;
        }

        if ($this->after !== []) {
            $configuration['after'] = $this->after;
        }

        return $configuration;
    }
}
