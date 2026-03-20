<?php

declare(strict_types = 1);

namespace Maispace\MaiMake\Command\Component;

use Maispace\MaiMake\Component\ComponentInterface;
use Maispace\MaiMake\Component\ExtbaseRepository;

/**
 * Command for creating a new Extbase domain repository component.
 */
class RepositoryCommand extends SimpleComponentCommand
{
    protected function configure(): void
    {
        parent::configure();
        $this->setDescription('Create an Extbase domain repository');
    }

    protected function createComponent(): ComponentInterface
    {
        $repository = new ExtbaseRepository($this->psr4Prefix);

        return $repository
            ->setName(
                $this->askString(
                    'Enter the name of the repository (e.g. "BlogPostRepository")',
                    null,
                    [$this, 'answerRequired']
                )
            )
            ->setDirectory(
                $this->askString(
                    'Enter the directory, the repository should be placed in',
                    $this->getProposalFromEnvironment('REPOSITORY_DIR', 'Domain/Repository')
                )
            );
    }

    protected function publishComponentConfiguration(ComponentInterface $component): bool
    {
        $this->io->success('Successfully created the repository ' . $component->getName() . '.');

        return true;
    }
}
