<?php

declare(strict_types = 1);

namespace Maispace\Make\Command\Component;

use Maispace\Make\Component\ComponentInterface;
use Maispace\Make\Component\Migration;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Command for creating a new data migration component
 */
class MigrationCommand extends SimpleComponentCommand
{
    protected function configure(): void
    {
        parent::configure();
        $this->setDescription('Create a data migration class');
    }

    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        parent::initialize($input, $output);
    }

    protected function createComponent(): ComponentInterface
    {
        $migration = new Migration($this->psr4Prefix);

        return $migration
            ->setName(
                $this->askString(
                    'Enter the name of the migration (e.g. "MigrateUserDataMigration")',
                    null,
                    [$this, 'answerRequired']
                )
            )
            ->setDirectory(
                $this->askString(
                    'Enter the directory, the migration should be placed in',
                    $this->getProposalFromEnvironment('MIGRATION_DIR', 'Migration')
                )
            )
            ->setDescription(
                $this->askString(
                    'Enter a short description for this migration',
                    $this->getProposalFromEnvironment('MIGRATION_DESCRIPTION', '')
                )
            );
    }

    protected function publishComponentConfiguration(ComponentInterface $component): bool
    {
        $this->io->success('Successfully created the migration ' . $component->getName() . '.');

        return true;
    }
}
