<?php

declare(strict_types = 1);

namespace Maispace\MaiMake\Command\Component;

use Maispace\MaiMake\Component\ComponentInterface;
use Maispace\MaiMake\Component\InterfaceComponent;

/**
 * Command for creating a new PHP interface.
 */
class InterfaceCommand extends SimpleComponentCommand
{
    protected function configure(): void
    {
        parent::configure();
        $this->setDescription('Create a PHP interface');
    }

    protected function createComponent(): ComponentInterface
    {
        $interface = new InterfaceComponent($this->psr4Prefix);

        return $interface
            ->setName(
                $this->askString(
                    'Enter the name of the interface (e.g. "UserRepositoryInterface")',
                    null,
                    [$this, 'answerRequired']
                )
            )
            ->setDirectory(
                $this->askString(
                    'Enter the directory, the interface should be placed in',
                    $this->getProposalFromEnvironment('INTERFACE_DIR', '')
                )
            );
    }

    protected function publishComponentConfiguration(ComponentInterface $component): bool
    {
        $this->io->success('Successfully created the interface ' . $component->getName() . '.');

        return true;
    }
}
