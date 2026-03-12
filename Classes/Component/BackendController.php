<?php

declare(strict_types = 1);

namespace Maispace\Make\Component;

/**
 * Backend controller component.
 */
class BackendController extends AbstractComponent implements ArrayConfigurationComponentInterface, ServiceConfigurationComponentInterface
{
    protected string $routeIdentifier = '';
    protected string $routePath = '';
    protected string $methodName = '';

    public function getRouteIdentifier(): string
    {
        return $this->routeIdentifier;
    }

    public function getRouteIdentifierProposal(string $prefix): string
    {
        return 'tx_' . trim($prefix, '_') . '_' . mb_strtolower(
            trim(str_replace('Controller', '', preg_replace('/(?<=\\w)([A-Z])/', '_\\1', $this->name) ?? ''), '_'),
            'utf-8'
        );
    }

    public function setRouteIdentifier(string $routeIdentifier): self
    {
        $this->routeIdentifier = trim(str_replace('-', '_', $routeIdentifier), '_');

        return $this;
    }

    public function getRoutePathProposal(): string
    {
        return mb_strtolower(
            '/' . trim(str_replace('_', '/', str_replace('tx_', '', $this->routeIdentifier)), '/)'),
            'utf-8'
        );
    }

    public function setRoutePath(string $routePath): self
    {
        $this->routePath = '/' . trim($routePath, '/');

        return $this;
    }

    public function setMethodName(string $methodName): self
    {
        $this->methodName = $methodName;

        return $this;
    }

    /** @return array<string, mixed> */
    public function getArrayConfiguration(): array
    {
        return [
            'path'   => $this->routePath,
            'target' => $this->getClassName() . ($this->methodName !== '' ? '::' . $this->methodName : ''),
        ];
    }

    public function __toString(): string
    {
        return $this->createFileContent(
            'BackendController.php',
            [
                'NAMESPACE' => $this->getNamespace(),
                'NAME'      => $this->name,
                'METHOD'    => $this->methodName ?: '__invoke',
            ]
        );
    }

    /** @return array<string, mixed> */
    public function getServiceConfiguration(): array
    {
        return [
            $this->getClassName() => [
                'tags' => [
                    'backend.controller',
                ],
            ],
        ];
    }
}
