<?php

declare(strict_types = 1);

namespace Maispace\Make\Command\Component;

use Maispace\Make\Component\ComponentInterface;
use Maispace\Make\Component\Hook;

/**
 * Command for creating a new TYPO3 hook class component.
 */
class HookCommand extends SimpleComponentCommand
{
    protected function configure(): void
    {
        parent::configure();
        $this->setDescription('Create a TYPO3 hook class');
    }

    protected function createComponent(): ComponentInterface
    {
        $hook = new Hook($this->psr4Prefix);

        return $hook
            ->setName(
                $this->askString(
                    'Enter the name of the hook class (e.g. "PageHook")',
                    null,
                    [$this, 'answerRequired']
                )
            )
            ->setDirectory(
                $this->askString(
                    'Enter the directory, the hook class should be placed in',
                    $this->getProposalFromEnvironment('HOOK_DIR', 'Hook')
                )
            );
    }

    protected function publishComponentConfiguration(ComponentInterface $component): bool
    {
        $this->io->success('Successfully created the hook class ' . $component->getName() . '.');

        return true;
    }
}
