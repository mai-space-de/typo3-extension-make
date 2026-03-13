<?php

declare(strict_types = 1);

namespace Maispace\Make\IO;

use Symfony\Component\Yaml\Yaml;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * IO operations for the service configuration of an extension.
 */
class ServiceConfiguration extends AbstractConfiguration
{
    private const CONFIGURATION_DIRECTORY = 'Configuration/';
    private const CONFIGURATION_FILE = 'Services.yaml';

    /**
     * Write / update the service configuration.
     *
     * @return bool Whether the service configuration was updated successfully
     */
    public function write(): bool
    {
        $directory = $this->packagePath . self::CONFIGURATION_DIRECTORY;
        if (!file_exists($directory)) {
            GeneralUtility::mkdir_deep($directory);
        }
        $file = $directory . self::CONFIGURATION_FILE;

        return GeneralUtility::writeFile($file, Yaml::dump($this->sortImportsOnTop($this->configuration), 99, 2), true);
    }

    /**
     * Initialize a new basic service configuration.
     */
    public function createBasicServiceConfiguration(string $psr4Prefix): void
    {
        $this->configuration['services'] = [
            '_defaults' => [
                'autowire'      => true,
                'autoconfigure' => true,
                'public'        => false,
            ],
            trim(str_replace('/', '\\', ucfirst($psr4Prefix)), '\\') . '\\' => [
                'resource' => '../Classes/*',
                'exclude'  => '../Classes/Domain/Model/*',
            ],
        ];
    }

    /**
     * Load the service configuration.
     *
     * @return array<string, mixed>
     */
    protected function load(): array
    {
        $serviceConfiguration = $this->packagePath . self::CONFIGURATION_DIRECTORY . self::CONFIGURATION_FILE;

        if (!file_exists($serviceConfiguration)) {
            return [];
        }

        try {
            $configuration = Yaml::parse(file_get_contents($serviceConfiguration) ?: '');
        } catch (\Exception $e) {
            return [];
        }

        /** @var array<string, mixed> $configuration */
        return is_array($configuration) ? $configuration : [];
    }

    /**
     * @param array<string, mixed> $newConfiguration
     *
     * @return array<string, mixed>
     */
    protected function sortImportsOnTop(array $newConfiguration): array
    {
        ksort($newConfiguration);
        if (isset($newConfiguration['imports'])) {
            $imports = $newConfiguration['imports'];
            unset($newConfiguration['imports']);
            $newConfiguration = array_merge(['imports' => $imports], $newConfiguration);
        }

        return $newConfiguration;
    }
}
