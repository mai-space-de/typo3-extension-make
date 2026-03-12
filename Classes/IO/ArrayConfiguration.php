<?php

declare(strict_types = 1);

namespace Maispace\Make\IO;

use TYPO3\CMS\Core\Utility\ArrayUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * IO operations for the array configurations of an extension.
 */
class ArrayConfiguration extends AbstractConfiguration
{
    protected string $file;
    protected string $directory;

    public function __construct(string $packagePath, string $file, string $directory)
    {
        $this->file = trim($file, '/');
        $this->directory = trim($directory, '/') . '/';
        parent::__construct($packagePath);
    }

    /**
     * Write / update the array configuration.
     *
     * @return bool Whether the array configuration was updated successfully
     */
    public function write(): bool
    {
        $directory = $this->packagePath . $this->directory;
        if (!file_exists($directory)) {
            GeneralUtility::mkdir_deep($directory);
        }
        $file = $directory . $this->file;

        return GeneralUtility::writeFile($file, "<?php\n\n" . 'return ' . ArrayUtility::arrayExport($this->configuration) . ";\n", true);
    }

    /**
     * Load the array configuration.
     *
     * @return array<string, mixed>
     */
    protected function load(): array
    {
        $configurationFile = $this->packagePath . $this->directory . $this->file;
        if (!file_exists($configurationFile)) {
            return [];
        }
        $configuration = require $configurationFile;

        /** @var array<string, mixed> $configuration */
        return is_array($configuration) ? $configuration : [];
    }
}
