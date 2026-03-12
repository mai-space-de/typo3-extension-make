<?php

declare(strict_types = 1);

namespace Maispace\Make\Command\Component;

use Maispace\Make\Component\ComponentInterface;
use Maispace\Make\Component\Middleware;
use Maispace\Make\Exception\AbortCommandException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Command for creating a new middleware component.
 */
class MiddlewareCommand extends SimpleComponentCommand
{
    protected function configure(): void
    {
        parent::configure();
        $this->setDescription('Create a PSR-15 middleware');
    }

    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        parent::initialize($input, $output);
        $this->initializeArrayConfiguration('RequestMiddlewares.php');
    }

    protected function createComponent(): ComponentInterface
    {
        $middleware = new Middleware($this->psr4Prefix);

        return $middleware
            ->setName(
                $this->askString(
                    'Enter the name of the middleware (e.g. "PostProcessContent")',
                    null,
                    [$this, 'answerRequired']
                )
            )
            ->setDirectory(
                $this->askString(
                    'Enter the directory, the middleware should be placed in',
                    $this->getProposalFromEnvironment('MIDDLEWARE_DIR', 'Middleware')
                )
            )
            ->setIdentifier(
                $this->askString(
                    'Enter an identifier for the middleware',
                    $middleware->getIdentifierProposal($this->getProposalFromEnvironment('MIDDLEWARE_IDENTIFIER_PREFIX'))
                )
            )
            ->setType(
                $this->askChoice(
                    'Choose the type (context) for the middleware',
                    ['frontend', 'backend'],
                    $this->getProposalFromEnvironment('MIDDLEWARE_TYPE', 'frontend')
                )
            )
            ->setBefore(
                GeneralUtility::trimExplode(
                    ',',
                    $this->askString('Enter a comma separated list of identifiers the new middleware should be executed beforehand'),
                    true
                )
            )
            ->setAfter(
                GeneralUtility::trimExplode(
                    ',',
                    $this->askString('Enter a comma separated list of identifiers after which the new middleware should be executed'),
                    true
                )
            );
    }

    /**
     * @param Middleware $component
     *
     * @throws AbortCommandException
     */
    protected function publishComponentConfiguration(ComponentInterface $component): bool
    {
        $middlewareConfiguration = $this->arrayConfiguration->getConfiguration();
        $type = $component->getType();
        $identifier = $component->getIdentifier();
        $typeConfig = is_array($middlewareConfiguration[$type] ?? null) ? $middlewareConfiguration[$type] : [];
        if (isset($typeConfig[$identifier])
            && !$this->io->confirm('The identifier ' . $identifier . ' already exists for type ' . $type . '. Do you want to override it?', true)
        ) {
            throw new AbortCommandException('Aborting middleware generation.', 1639664755);
        }

        $typeConfig[$identifier] = $component->getArrayConfiguration();
        $middlewareConfiguration[$type] = $typeConfig;
        $this->arrayConfiguration->setConfiguration($middlewareConfiguration);
        if (!$this->writeArrayConfiguration()) {
            $this->io->error('Updating middleware configuration failed.');

            return false;
        }

        $this->io->success('Successfully created the middleware ' . $component->getName() . ' (' . $identifier . ').');

        return true;
    }
}
