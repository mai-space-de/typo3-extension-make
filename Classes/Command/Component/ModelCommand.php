<?php

declare(strict_types = 1);

namespace Maispace\Make\Command\Component;

use Maispace\Make\Component\ComponentInterface;
use Maispace\Make\Component\Model;

/**
 * Command for creating a new Extbase domain model component.
 */
class ModelCommand extends SimpleComponentCommand
{
    protected function configure(): void
    {
        parent::configure();
        $this->setDescription('Create an Extbase domain model');
    }

    protected function createComponent(): ComponentInterface
    {
        $model = new Model($this->psr4Prefix);

        return $model
            ->setName(
                $this->askString(
                    'Enter the name of the model (e.g. "BlogPost")',
                    null,
                    [$this, 'answerRequired']
                )
            )
            ->setDirectory(
                $this->askString(
                    'Enter the directory, the model should be placed in',
                    $this->getProposalFromEnvironment('MODEL_DIR', 'Domain/Model')
                )
            );
    }

    protected function publishComponentConfiguration(ComponentInterface $component): bool
    {
        $this->io->success('Successfully created the model ' . $component->getName() . '.');

        return true;
    }
}
