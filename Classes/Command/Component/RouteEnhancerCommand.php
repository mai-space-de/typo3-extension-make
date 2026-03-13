<?php

declare(strict_types = 1);

namespace Maispace\Make\Command\Component;

use Maispace\Make\Component\ComponentInterface;
use Maispace\Make\Component\RouteEnhancer;

/**
 * Command for creating a new custom route enhancer component.
 */
class RouteEnhancerCommand extends SimpleComponentCommand
{
    protected function configure(): void
    {
        parent::configure();
        $this->setDescription('Create a custom route enhancer');
    }

    protected function createComponent(): ComponentInterface
    {
        $routeEnhancer = new RouteEnhancer($this->psr4Prefix);

        return $routeEnhancer
            ->setName(
                $this->askString(
                    'Enter the name of the route enhancer (e.g. "BlogRouteEnhancer")',
                    null,
                    [$this, 'answerRequired']
                )
            )
            ->setDirectory(
                $this->askString(
                    'Enter the directory, the route enhancer should be placed in',
                    $this->getProposalFromEnvironment('ROUTE_ENHANCER_DIR', 'Routing/Enhancer')
                )
            );
    }

    protected function publishComponentConfiguration(ComponentInterface $component): bool
    {
        $this->io->success('Successfully created the route enhancer ' . $component->getName() . '.');

        return true;
    }
}
