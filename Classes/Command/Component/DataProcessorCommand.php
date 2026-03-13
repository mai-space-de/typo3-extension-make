<?php

declare(strict_types = 1);

namespace Maispace\Make\Command\Component;

use Maispace\Make\Component\ComponentInterface;
use Maispace\Make\Component\DataProcessor;

/**
 * Command for creating a new TypoScript data processor component.
 */
class DataProcessorCommand extends SimpleComponentCommand
{
    protected function configure(): void
    {
        parent::configure();
        $this->setDescription('Create a TypoScript data processor');
    }

    protected function createComponent(): ComponentInterface
    {
        $dataProcessor = new DataProcessor($this->psr4Prefix);

        return $dataProcessor
            ->setName(
                $this->askString(
                    'Enter the name of the data processor (e.g. "MyDataProcessor")',
                    null,
                    [$this, 'answerRequired']
                )
            )
            ->setDirectory(
                $this->askString(
                    'Enter the directory, the data processor should be placed in',
                    $this->getProposalFromEnvironment('DATA_PROCESSOR_DIR', 'DataProcessing')
                )
            );
    }

    protected function publishComponentConfiguration(ComponentInterface $component): bool
    {
        $this->io->success('Successfully created the data processor ' . $component->getName() . '.');

        return true;
    }
}
