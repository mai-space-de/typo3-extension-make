<?php

declare(strict_types = 1);

namespace Maispace\MaiMake\Command\Component;

use Maispace\MaiMake\Component\ComponentInterface;
use Maispace\MaiMake\Component\Service;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Command for creating a new service component.
 */
class ServiceCommand extends SimpleComponentCommand
{
    protected function configure(): void
    {
        parent::configure();
        $this->setDescription('Create a service class');
    }

    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        parent::initialize($input, $output);
    }

    protected function createComponent(): ComponentInterface
    {
        $service = new Service($this->psr4Prefix);

        return $service
            ->setName(
                $this->askString(
                    'Enter the name of the service (e.g. "UserService")',
                    null,
                    [$this, 'answerRequired']
                )
            )
            ->setDirectory(
                $this->askString(
                    'Enter the directory, the service should be placed in',
                    $this->getProposalFromEnvironment('SERVICE_DIR', 'Service')
                )
            );
    }

    protected function publishComponentConfiguration(ComponentInterface $component): bool
    {
        $this->io->success('Successfully created the service ' . $component->getName() . '.');

        return true;
    }
}
