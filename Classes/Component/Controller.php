<?php

declare(strict_types = 1);

namespace Maispace\Make\Component;

/**
 * Frontend (Extbase) controller component
 */
class Controller extends AbstractComponent
{
    protected string $actionName = 'index';

    public function setActionName(string $actionName): self
    {
        $this->actionName = lcfirst(str_replace('Action', '', $actionName));

        return $this;
    }

    public function getActionName(): string
    {
        return $this->actionName;
    }

    public function __toString(): string
    {
        return $this->createFileContent(
            'Controller.php',
            [
                'NAMESPACE'   => $this->getNamespace(),
                'NAME'        => $this->name,
                'ACTION_NAME' => $this->actionName,
            ]
        );
    }
}
