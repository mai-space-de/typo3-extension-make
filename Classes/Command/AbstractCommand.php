<?php

declare(strict_types=1);

namespace Maispace\Make\Command;

use Maispace\Make\Environment\Variables;
use Maispace\Make\Exception\EmptyAnswerException;
use Maispace\Make\Exception\InvalidPackageNameException;
use Maispace\Make\PackageResolver;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use TYPO3\CMS\Core\Package\PackageInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Abstract command with basic functionalities
 */
abstract class AbstractCommand extends Command
{
    protected SymfonyStyle $io;
    protected PackageResolver $packageResolver;

    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        $this->io = new SymfonyStyle($input, $output);
        $this->packageResolver = GeneralUtility::makeInstance(PackageResolver::class);
    }

    protected function getProposalFromEnvironment(string $key, string $default = ''): string
    {
        return Variables::has($key) ? Variables::get($key) : $default;
    }

    /**
     * @param mixed $answer
     */
    public function answerRequired(mixed $answer): string
    {
        $answer = (string)$answer;

        if (trim($answer) === '') {
            throw new EmptyAnswerException('Answer can not be empty.', 1639664759);
        }

        return $answer;
    }

    /**
     * @param mixed $answer
     *
     * @see https://getcomposer.org/doc/04-schema.md#name
     */
    public function validatePackageKey(mixed $answer): string
    {
        $answer = $this->answerRequired($answer);

        if (!preg_match('/^[a-z0-9]([_.-]?[a-z0-9]+)*\/[a-z0-9](([_.]?|-{0,2})[a-z0-9]+)*$/', $answer)) {
            throw new InvalidPackageNameException(
                'Package key does not match the allowed pattern. More information are available on https://getcomposer.org/doc/04-schema.md#name.',
                1639664760
            );
        }

        return $answer;
    }

    /**
     * Resolve package using the extension key from either input argument, environment variable or CLI
     */
    protected function getPackage(InputInterface $input): ?PackageInterface
    {
        if ($input->hasArgument('extensionKey')
            && ($key = ($input->getArgument('extensionKey') ?? '')) !== ''
        ) {
            return $this->packageResolver->resolvePackage($key);
        }

        if (($key = $this->getProposalFromEnvironment('EXTENSION_KEY')) !== '') {
            return $this->packageResolver->resolvePackage($key);
        }

        if (($key = $this->askForExtensionKey()) !== '') {
            $this->io->note('You can also always set the extension key as argument or by using an environment variable.');

            return $this->packageResolver->resolvePackage($key);
        }

        return null;
    }

    /**
     * Let user select an extension to work with.
     */
    protected function askForExtensionKey(): string
    {
        $packages = $this->packageResolver->getAvailablePackages();
        $choices = array_reduce($packages, static function ($result, PackageInterface $package) {
            if ($package->getValueFromComposerManifest('type') === 'typo3-cms-extension' && $package->getPackageKey() !== 'maispace_make') {
                $extensionKey = $package->getPackageKey();
                $result[$extensionKey] = $extensionKey;
            }

            return $result;
        }, []);

        if (!$choices) {
            throw new \LogicException('No available extension found. You may want to create one first.');
        }

        return (string)$this->io->choice('Select a extension to work on', $choices);
    }
}
