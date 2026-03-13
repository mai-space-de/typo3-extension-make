<?php

declare(strict_types = 1);

namespace Maispace\Make;

use TYPO3\CMS\Core\Package\Exception\UnknownPackageException;
use TYPO3\CMS\Core\Package\PackageInterface;
use TYPO3\CMS\Core\Package\PackageManager;

/**
 * Resolves packages using the TYPO3 PackageManager.
 */
class PackageResolver
{
    protected PackageManager $packageManager;

    public function __construct(PackageManager $packageManager)
    {
        $this->packageManager = $packageManager;
    }

    public function resolvePackage(string $extensionKey): ?PackageInterface
    {
        try {
            return $this->packageManager->getPackage($extensionKey);
        } catch (UnknownPackageException $e) {
            return null;
        }
    }

    /**
     * @return PackageInterface[]
     */
    public function getAvailablePackages(): array
    {
        return $this->packageManager->getAvailablePackages();
    }
}
