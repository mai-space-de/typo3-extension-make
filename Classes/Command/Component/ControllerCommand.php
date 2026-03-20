<?php

declare(strict_types = 1);

namespace Maispace\MaiMake\Command\Component;

use Maispace\MaiMake\Component\ComponentInterface;
use Maispace\MaiMake\Component\Controller;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Command for creating a new Extbase controller component.
 */
class ControllerCommand extends SimpleComponentCommand
{
    protected function configure(): void
    {
        parent::configure();
        $this->setDescription('Create an Extbase action controller');
    }

    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        parent::initialize($input, $output);
    }

    protected function createComponent(): ComponentInterface
    {
        $controller = new Controller($this->psr4Prefix);

        return $controller
            ->setName(
                $this->askString(
                    'Enter the name of the controller (e.g. "BlogController")',
                    null,
                    [$this, 'answerRequired']
                )
            )
            ->setDirectory(
                $this->askString(
                    'Enter the directory, the controller should be placed in',
                    $this->getProposalFromEnvironment('CONTROLLER_DIR', 'Controller')
                )
            )
            ->setActionName(
                $this->askString(
                    'Enter the name of the first action (e.g. "index")',
                    $this->getProposalFromEnvironment('CONTROLLER_ACTION', 'index')
                )
            );
    }

    protected function publishComponentConfiguration(ComponentInterface $component): bool
    {
        $this->io->success('Successfully created the controller ' . $component->getName() . '.');

        return true;
    }
}
