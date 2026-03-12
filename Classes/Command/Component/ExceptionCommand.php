<?php

declare(strict_types=1);

namespace Maispace\Make\Command\Component;

use Maispace\Make\Component\ComponentInterface;
use Maispace\Make\Component\ExceptionComponent;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Command for creating a new PHP exception class
 */
class ExceptionCommand extends SimpleComponentCommand
{
    protected function configure(): void
    {
        parent::configure();
        $this->setDescription('Create a PHP exception class');
    }

    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        parent::initialize($input, $output);
    }

    protected function createComponent(): ComponentInterface
    {
        $exception = new ExceptionComponent($this->psr4Prefix);

        return $exception
            ->setName(
                (string)$this->io->ask(
                    'Enter the name of the exception (e.g. "InvalidArgumentException")',
                    null,
                    [$this, 'answerRequired']
                )
            )
            ->setDirectory(
                (string)$this->io->ask(
                    'Enter the directory, the exception should be placed in',
                    $this->getProposalFromEnvironment('EXCEPTION_DIR', 'Exception')
                )
            )
            ->setParentClass(
                (string)$this->io->ask(
                    'Enter the parent class to extend',
                    $this->getProposalFromEnvironment('EXCEPTION_PARENT', '\\RuntimeException')
                )
            );
    }

    protected function publishComponentConfiguration(ComponentInterface $component): bool
    {
        $this->io->success('Successfully created the exception ' . $component->getName() . '.');

        return true;
    }
}
