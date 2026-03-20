<?php

declare(strict_types = 1);

namespace Maispace\MaiMake\Command\Component;

use Maispace\MaiMake\Component\ComponentInterface;
use Maispace\MaiMake\Component\EnumComponent;

/**
 * Command for creating a new PHP enum component.
 */
class EnumCommand extends SimpleComponentCommand
{
    protected function configure(): void
    {
        parent::configure();
        $this->setDescription('Create a PHP enum');
    }

    protected function createComponent(): ComponentInterface
    {
        $enum = new EnumComponent($this->psr4Prefix);

        $backingTypeChoice = $this->askChoice(
            'Select the backing type for the enum',
            ['string', 'int', 'none'],
            $this->getProposalFromEnvironment('ENUM_BACKING_TYPE', 'string')
        );

        return $enum
            ->setName(
                $this->askString(
                    'Enter the name of the enum (e.g. "Status")',
                    null,
                    [$this, 'answerRequired']
                )
            )
            ->setDirectory(
                $this->askString(
                    'Enter the directory, the enum should be placed in',
                    $this->getProposalFromEnvironment('ENUM_DIR', 'Enum')
                )
            )
            ->setBackingType($backingTypeChoice === 'none' ? '' : $backingTypeChoice);
    }

    protected function publishComponentConfiguration(ComponentInterface $component): bool
    {
        $this->io->success('Successfully created the enum ' . $component->getName() . '.');

        return true;
    }
}
