<?php

declare(strict_types=1);

namespace Maispace\Make\Command\Component;

use Maispace\Make\Component\ComponentInterface;
use Maispace\Make\Component\UpgradeWizard;
use Maispace\Make\Exception\AbortCommandException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Command for creating a new upgrade wizard component
 */
class UpgradeWizardCommand extends SimpleComponentCommand
{
    protected function configure(): void
    {
        parent::configure();
        $this->setDescription('Create a TYPO3 upgrade wizard');
    }

    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        parent::initialize($input, $output);
        $this->initializeServiceConfiguration();
    }

    protected function createComponent(): ComponentInterface
    {
        $upgradeWizard = new UpgradeWizard($this->psr4Prefix);

        return $upgradeWizard
            ->setName(
                (string)$this->io->ask(
                    'Enter the name of the upgrade wizard (e.g. "MigrateSlugUpgradeWizard")',
                    null,
                    [$this, 'answerRequired']
                )
            )
            ->setDirectory(
                (string)$this->io->ask(
                    'Enter the directory, the upgrade wizard should be placed in',
                    $this->getProposalFromEnvironment('UPGRADE_WIZARD_DIR', 'UpgradeWizard')
                )
            )
            ->setIdentifier(
                (string)$this->io->ask(
                    'Enter the unique identifier for the upgrade wizard',
                    $upgradeWizard->getIdentifierProposalForWizard($this->getProposalFromEnvironment('UPGRADE_WIZARD_PREFIX', $this->extensionKey))
                )
            )
            ->setTitle(
                (string)$this->io->ask(
                    'Enter a human-readable title for the upgrade wizard',
                    $this->getProposalFromEnvironment('UPGRADE_WIZARD_TITLE', '')
                )
            );
    }

    /**
     * @param UpgradeWizard $component
     * @throws AbortCommandException
     */
    protected function publishComponentConfiguration(ComponentInterface $component): bool
    {
        if (!$this->writeServiceConfiguration($component)) {
            $this->io->error('Updating the service configuration failed.');

            return false;
        }

        $this->io->success('Successfully created the upgrade wizard ' . $component->getName() . ' (' . $component->getIdentifier() . ').');

        return true;
    }
}
