<?php

declare(strict_types = 1);

namespace Maispace\Make\Command\Component;

use Maispace\Make\Component\ComponentInterface;
use Maispace\Make\Component\Validator;

/**
 * Command for creating a new Extbase validator component.
 */
class ValidatorCommand extends SimpleComponentCommand
{
    protected function configure(): void
    {
        parent::configure();
        $this->setDescription('Create an Extbase validator');
    }

    protected function createComponent(): ComponentInterface
    {
        $validator = new Validator($this->psr4Prefix);

        return $validator
            ->setName(
                $this->askString(
                    'Enter the name of the validator (e.g. "NotEmptyValidator")',
                    null,
                    [$this, 'answerRequired']
                )
            )
            ->setDirectory(
                $this->askString(
                    'Enter the directory, the validator should be placed in',
                    $this->getProposalFromEnvironment('VALIDATOR_DIR', 'Validator')
                )
            );
    }

    protected function publishComponentConfiguration(ComponentInterface $component): bool
    {
        $this->io->success('Successfully created the validator ' . $component->getName() . '.');

        return true;
    }
}
