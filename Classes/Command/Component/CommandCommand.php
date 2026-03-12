<?php

declare(strict_types=1);

namespace Maispace\Make\Command\Component;

use Maispace\Make\Component\Command;
use Maispace\Make\Component\ComponentInterface;
use Maispace\Make\Exception\AbortCommandException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Command for creating a new console command component
 */
class CommandCommand extends SimpleComponentCommand
{
    protected function configure(): void
    {
        parent::configure();
        $this->setDescription('Create a console command');
    }

    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        parent::initialize($input, $output);
        $this->initializeServiceConfiguration();
    }

    protected function createComponent(): ComponentInterface
    {
        $command = new Command($this->psr4Prefix);

        return $command
            ->setName(
                (string)$this->io->ask(
                    'Enter the name of the command (e.g. "AwesomeCommand")?',
                    null,
                    [$this, 'answerRequired']
                )
            )
            ->setDirectory(
                (string)$this->io->ask(
                    'Enter the directory, the command should be placed in',
                    $this->getProposalFromEnvironment('COMMAND_DIR', 'Command')
                )
            )
            ->setCommandName(
                (string)$this->io->ask(
                    'Enter the command name to execute on CLI',
                    $command->getCommandNameProposal($this->getProposalFromEnvironment('COMMAND_NAME_PREFIX', $this->extensionKey))
                )
            )
            ->setDescription(
                (string)$this->io->ask(
                    'Enter a short description for the command',
                    null,
                    [$this, 'answerRequired']
                )
            )
            ->setSchedulable(
                (bool)$this->io->confirm('Should the command be schedulable?', false)
            );
    }

    /**
     * @param Command $component
     * @throws AbortCommandException
     */
    protected function publishComponentConfiguration(ComponentInterface $component): bool
    {
        if (!$this->writeServiceConfiguration($component)) {
            $this->io->error('Updating the service configuration failed.');

            return false;
        }

        $this->io->success('Successfully created the command ' . $component->getName() . ' (' . $component->getCommandName() . ').');

        return true;
    }
}
