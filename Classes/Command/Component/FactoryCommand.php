<?php

declare(strict_types = 1);

namespace Maispace\Make\Command\Component;

use Maispace\Make\Component\ComponentInterface;
use Maispace\Make\Component\Factory;

/**
 * Command for creating a new factory class component.
 */
class FactoryCommand extends SimpleComponentCommand
{
    protected function configure(): void
    {
        parent::configure();
        $this->setDescription('Create a factory class');
    }

    protected function createComponent(): ComponentInterface
    {
        $factory = new Factory($this->psr4Prefix);

        return $factory
            ->setName(
                $this->askString(
                    'Enter the name of the factory (e.g. "UserFactory")',
                    null,
                    [$this, 'answerRequired']
                )
            )
            ->setDirectory(
                $this->askString(
                    'Enter the directory, the factory should be placed in',
                    $this->getProposalFromEnvironment('FACTORY_DIR', 'Factory')
                )
            );
    }

    protected function publishComponentConfiguration(ComponentInterface $component): bool
    {
        $this->io->success('Successfully created the factory ' . $component->getName() . '.');

        return true;
    }
}
