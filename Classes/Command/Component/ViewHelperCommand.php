<?php

declare(strict_types=1);

namespace Maispace\Make\Command\Component;

use Maispace\Make\Component\ComponentInterface;
use Maispace\Make\Component\ViewHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Command for creating a new Fluid ViewHelper component
 */
class ViewHelperCommand extends SimpleComponentCommand
{
    protected function configure(): void
    {
        parent::configure();
        $this->setDescription('Create a Fluid ViewHelper');
    }

    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        parent::initialize($input, $output);
    }

    protected function createComponent(): ComponentInterface
    {
        $viewHelper = new ViewHelper($this->psr4Prefix);

        return $viewHelper
            ->setName(
                (string)$this->io->ask(
                    'Enter the name of the ViewHelper (e.g. "FormatDateViewHelper")',
                    null,
                    [$this, 'answerRequired']
                )
            )
            ->setDirectory(
                (string)$this->io->ask(
                    'Enter the directory, the ViewHelper should be placed in',
                    $this->getProposalFromEnvironment('VIEWHELPER_DIR', 'ViewHelpers')
                )
            );
    }

    protected function publishComponentConfiguration(ComponentInterface $component): bool
    {
        $this->io->success('Successfully created the ViewHelper ' . $component->getName() . '.');

        return true;
    }
}
