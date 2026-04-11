<?php

declare(strict_types=1);

namespace {{NAMESPACE}};

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class {{NAME}} extends ActionController
{
    public function {{ACTION_NAME}}Action(): ResponseInterface
    {
        // Do awesome stuff
        return $this->htmlResponse();
    }
}
