<?php

declare(strict_types = 1);

namespace Maispace\Make\Command\Component;

use Maispace\Make\Component\ComponentInterface;
use Maispace\Make\Component\TraitComponent;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Command for creating a new PHP trait.
 */
class TraitCommand extends SimpleComponentCommand
{
    protected function configure(): void
    {
        parent::configure();
        $this->setDescription('Create a PHP trait');
    }

    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        parent::initialize($input, $output);
    }

    protected function createComponent(): ComponentInterface
    {
        $trait = new TraitComponent($this->psr4Prefix);

        return $trait
            ->setName(
                $this->askString(
                    'Enter the name of the trait (e.g. "HasTimestampsTrait")',
                    null,
                    [$this, 'answerRequired']
                )
            )
            ->setDirectory(
                $this->askString(
                    'Enter the directory, the trait should be placed in',
                    $this->getProposalFromEnvironment('TRAIT_DIR', 'Trait')
                )
            );
    }

    protected function publishComponentConfiguration(ComponentInterface $component): bool
    {
        $this->io->success('Successfully created the trait ' . $component->getName() . '.');

        return true;
    }
}
