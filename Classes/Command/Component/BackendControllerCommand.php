<?php

declare(strict_types = 1);

namespace Maispace\Make\Command\Component;

use Maispace\Make\Component\BackendController;
use Maispace\Make\Component\ComponentInterface;
use Maispace\Make\Exception\AbortCommandException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Command for creating a new backend controller component.
 */
class BackendControllerCommand extends SimpleComponentCommand
{
    protected function configure(): void
    {
        parent::configure();
        $this->setDescription('Create a backend controller');
    }

    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        parent::initialize($input, $output);
        $this->initializeServiceConfiguration();
        $this->initializeArrayConfiguration('Routes.php', 'Configuration/Backend/');
    }

    protected function createComponent(): ComponentInterface
    {
        $backendController = new BackendController($this->psr4Prefix);

        return $backendController
            ->setName(
                $this->askString(
                    'Enter the name of the backend controller (e.g. "AwesomeController")',
                    null,
                    [$this, 'answerRequired']
                )
            )
            ->setDirectory(
                $this->askString(
                    'Enter the directory, the backend controller should be placed in',
                    $this->getProposalFromEnvironment('BACKEND_CONTROLLER_DIR', 'Backend/Controller')
                )
            )
            ->setRouteIdentifier(
                $this->askString(
                    'Enter the route identifier for the backend controller',
                    $backendController->getRouteIdentifierProposal($this->getProposalFromEnvironment('BACKEND_CONTROLLER_PREFIX', $this->extensionKey))
                )
            )
            ->setRoutePath(
                $this->askString(
                    'Enter the route path of the backend controller?',
                    $backendController->getRoutePathProposal()
                )
            )
            ->setMethodName(
                $this->askString('Enter the method, which should handle the request - LEAVE EMPTY FOR USING __invoke()')
            );
    }

    /**
     * @param BackendController $component
     *
     * @throws AbortCommandException
     */
    protected function publishComponentConfiguration(ComponentInterface $component): bool
    {
        if (!$this->writeServiceConfiguration($component)) {
            $this->io->error('Updating the service configuration failed.');

            return false;
        }

        $routeConfiguration = $this->arrayConfiguration->getConfiguration();
        if (isset($routeConfiguration[$component->getRouteIdentifier()])
            && !$this->io->confirm('The route identifier ' . $component->getRouteIdentifier() . ' already exists. Do you want to override it?', true)
        ) {
            throw new AbortCommandException('Aborting backend controller generation.', 1639664754);
        }

        $routeConfiguration[$component->getRouteIdentifier()] = $component->getArrayConfiguration();
        $this->arrayConfiguration->setConfiguration($routeConfiguration);
        if (!$this->writeArrayConfiguration()) {
            $this->io->error('Updating the routing configuration failed.');

            return false;
        }

        $this->io->success('Successfully created the backend controller ' . $component->getName() . ' (' . $component->getRouteIdentifier() . ').');

        return true;
    }
}
