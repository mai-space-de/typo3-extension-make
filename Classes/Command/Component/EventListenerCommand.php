<?php

declare(strict_types = 1);

namespace Maispace\Make\Command\Component;

use Maispace\Make\Component\ComponentInterface;
use Maispace\Make\Component\EventListener;
use Maispace\Make\Exception\AbortCommandException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Command for creating a new event listener component
 */
class EventListenerCommand extends SimpleComponentCommand
{
    protected function configure(): void
    {
        parent::configure();
        $this->setDescription('Create a PSR-14 event listener');
    }

    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        parent::initialize($input, $output);
        $this->initializeServiceConfiguration();
    }

    protected function createComponent(): ComponentInterface
    {
        $eventListener = new EventListener($this->psr4Prefix);

        return $eventListener
            ->setEventName(
                $this->askString(
                    'Enter the event to listen for? - Use the FQN',
                    null,
                    [$this, 'answerRequired']
                )
            )
            ->setName(
                $this->askString(
                    'Enter the name of the listener (e.g. "AwesomeEventListener")',
                    $eventListener->getNameProposal()
                )
            )
            ->setDirectory(
                $this->askString(
                    'Enter the directory, the listener should be placed in',
                    $this->getProposalFromEnvironment('EVENT_LISTENER_DIR', 'EventListener')
                )
            )
            ->setIdentifier(
                $this->askString(
                    'Enter an identifier for the listener',
                    $eventListener->getIdentifierProposal($this->getProposalFromEnvironment('EVENT_LISTENER_IDENTIFIER_PREFIX'))
                )
            )
            ->setMethodName(
                $this->askString('Enter the method, which should receive the event - LEAVE EMPTY FOR USING __invoke()')
            );
    }

    /**
     * @param EventListener $component
     * @throws AbortCommandException
     */
    protected function publishComponentConfiguration(ComponentInterface $component): bool
    {
        if (!$this->writeServiceConfiguration($component)) {
            $this->io->error('Updating the service configuration failed.');

            return false;
        }

        $this->io->success('Successfully created the event listener ' . $component->getName() . ' for event ' . $component->getEventName());

        return true;
    }
}
