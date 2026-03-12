<?php

declare(strict_types=1);

namespace Maispace\Make\Component;

/**
 * Database migration component
 */
class Migration extends AbstractComponent
{
    protected string $description = '';

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function __toString(): string
    {
        return $this->createFileContent(
            'Migration.php',
            [
                'NAMESPACE'   => $this->getNamespace(),
                'NAME'        => $this->name,
                'DESCRIPTION' => str_replace('\'', '\\\'', $this->description),
            ]
        );
    }
}
