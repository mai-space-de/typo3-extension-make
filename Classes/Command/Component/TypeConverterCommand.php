<?php

declare(strict_types = 1);

namespace Maispace\Make\Command\Component;

use Maispace\Make\Component\ComponentInterface;
use Maispace\Make\Component\TypeConverter;

/**
 * Command for creating a new Extbase property type converter component.
 */
class TypeConverterCommand extends SimpleComponentCommand
{
    protected function configure(): void
    {
        parent::configure();
        $this->setDescription('Create an Extbase property type converter');
    }

    protected function createComponent(): ComponentInterface
    {
        $typeConverter = new TypeConverter($this->psr4Prefix);

        return $typeConverter
            ->setName(
                $this->askString(
                    'Enter the name of the type converter (e.g. "StringToDateTimeConverter")',
                    null,
                    [$this, 'answerRequired']
                )
            )
            ->setDirectory(
                $this->askString(
                    'Enter the directory, the type converter should be placed in',
                    $this->getProposalFromEnvironment('TYPE_CONVERTER_DIR', 'Property/TypeConverter')
                )
            );
    }

    protected function publishComponentConfiguration(ComponentInterface $component): bool
    {
        $this->io->success('Successfully created the type converter ' . $component->getName() . '.');

        return true;
    }
}
