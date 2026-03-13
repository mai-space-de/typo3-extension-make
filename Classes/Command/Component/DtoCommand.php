<?php

declare(strict_types = 1);

namespace Maispace\Make\Command\Component;

use Maispace\Make\Component\ComponentInterface;
use Maispace\Make\Component\Dto;

/**
 * Command for creating a new Data Transfer Object component.
 */
class DtoCommand extends SimpleComponentCommand
{
    protected function configure(): void
    {
        parent::configure();
        $this->setDescription('Create a Data Transfer Object (DTO)');
    }

    protected function createComponent(): ComponentInterface
    {
        $dto = new Dto($this->psr4Prefix);

        return $dto
            ->setName(
                $this->askString(
                    'Enter the name of the DTO (e.g. "UserDto")',
                    null,
                    [$this, 'answerRequired']
                )
            )
            ->setDirectory(
                $this->askString(
                    'Enter the directory, the DTO should be placed in',
                    $this->getProposalFromEnvironment('DTO_DIR', 'Dto')
                )
            );
    }

    protected function publishComponentConfiguration(ComponentInterface $component): bool
    {
        $this->io->success('Successfully created the DTO ' . $component->getName() . '.');

        return true;
    }
}
