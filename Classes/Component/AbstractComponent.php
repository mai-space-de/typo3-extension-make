<?php

declare(strict_types = 1);

namespace Maispace\Make\Component;

/**
 * Abstract class for components
 */
abstract class AbstractComponent implements ComponentInterface
{
    protected string $psr4Prefix;
    protected string $name = '';
    protected string $directory = '';

    public function __construct(string $psr4Prefix)
    {
        $this->psr4Prefix = ucfirst(trim(str_replace('/', '\\', $psr4Prefix), '\\')) . '\\';
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = ucfirst(str_replace(['/', '\\'], '', $name));

        return $this;
    }

    public function getDirectory(): string
    {
        return $this->directory;
    }

    public function setDirectory(string $directory): static
    {
        $this->directory = ltrim($directory, '/');

        return $this;
    }

    public function getClassName(): string
    {
        return $this->getNamespace() . '\\' . $this->name;
    }

    public function getIdentifierProposal(string $prefix = ''): string
    {
        $packagePrefix = $prefix ?: mb_strtolower(
            trim(
                preg_replace(
                    '/(?<=\\w)([A-Z])/',
                    '-\\1',
                    trim(str_replace('\\', '/', $this->psr4Prefix), '/')
                ) ?? '',
                '-'
            ),
            'utf-8'
        );

        $identifier = mb_strtolower(
            trim(preg_replace('/(?<=\\w)([A-Z])/', '-\\1', $this->name) ?? '', '-'),
            'utf-8'
        );

        return $packagePrefix . '/' . $identifier;
    }

    protected function getNamespace(): string
    {
        return rtrim($this->psr4Prefix . ucfirst(trim(str_replace('/', '\\', $this->directory), '\\')), '\\');
    }

    /**
     * @param array<string, string> $replace
     */
    protected function createFileContent(string $fileName, array $replace): string
    {
        $template = file_get_contents(__DIR__ . '/../../Resources/Private/CodeTemplates/' . $fileName);

        return (string)preg_replace_callback(
            '/\{\{([A-Z_]*)\}\}/',
            static function (array $result) use ($replace): string {
                return $replace[$result[1]] ?? $result[0];
            },
            $template !== false ? $template : ''
        );
    }
}
