<?php

declare(strict_types = 1);

namespace Maispace\Make\Command\Component;

use Maispace\Make\Component\ComponentInterface;
use Maispace\Make\Component\Utility;

/**
 * Command for creating a new utility class component.
 */
class UtilityCommand extends SimpleComponentCommand
{
    protected function configure(): void
    {
        parent::configure();
        $this->setDescription('Create a utility class');
    }

    protected function createComponent(): ComponentInterface
    {
        $utility = new Utility($this->psr4Prefix);

        return $utility
            ->setName(
                $this->askString(
                    'Enter the name of the utility class (e.g. "StringUtility")',
                    null,
                    [$this, 'answerRequired']
                )
            )
            ->setDirectory(
                $this->askString(
                    'Enter the directory, the utility class should be placed in',
                    $this->getProposalFromEnvironment('UTILITY_DIR', 'Utility')
                )
            );
    }

    protected function publishComponentConfiguration(ComponentInterface $component): bool
    {
        $this->io->success('Successfully created the utility class ' . $component->getName() . '.');

        return true;
    }
}
