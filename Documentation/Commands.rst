.. include:: /Includes.rst.txt

.. _commands:

========
Commands
========

All commands accept an optional ``extensionKey`` argument. When omitted the command
asks you to select from the currently active extensions.

.. code-block:: bash

    vendor/bin/typo3 make:<command> [extensionKey]

Most answers can also be pre-supplied via :ref:`environment-variables`.

----

.. _cmd-backendcontroller:

make:backendcontroller
======================

Creates an Extbase-free **backend controller** that handles a custom backend route.

.. code-block:: bash

    vendor/bin/typo3 make:backendcontroller my_extension

**Prompts**

*  Controller class name (e.g. ``AwesomeController``)
*  Directory (default: ``Backend/Controller``)
*  Route identifier (auto-proposed from the extension key and class name)
*  Route path (auto-proposed from the route identifier)
*  Method name (leave empty to use ``__invoke()``)

**Files written**

*  ``Classes/Backend/Controller/<Name>.php`` — PSR-7 controller class
*  ``Configuration/Backend/Routes.php`` — route entry added/updated
*  ``Configuration/Services.yaml`` — ``backend.controller`` tag added

**Example output** (``AwesomeController.php``):

.. code-block:: php

    <?php
    declare(strict_types=1);
    namespace Vendor\Extension\Backend\Controller;

    use Psr\Http\Message\ResponseInterface;
    use Psr\Http\Message\ServerRequestInterface;

    class AwesomeController
    {
        public function __invoke(ServerRequestInterface $request): ResponseInterface
        {
            // Do awesome stuff
        }
    }

----

.. _cmd-command:

make:command
============

Creates a **Symfony console command** and registers it in ``Services.yaml``.

.. code-block:: bash

    vendor/bin/typo3 make:command my_extension

**Prompts**

*  Class name (e.g. ``AwesomeCommand``)
*  Directory (default: ``Command``)
*  CLI command name (e.g. ``my-ext:awesome``)
*  Short description
*  Schedulable? (yes/no, default: no)

**Files written**

*  ``Classes/Command/<Name>.php``
*  ``Configuration/Services.yaml`` — ``console.command`` tag added

----

.. _cmd-controller:

make:controller
===============

Creates an **Extbase** ``ActionController``.

.. code-block:: bash

    vendor/bin/typo3 make:controller my_extension

**Prompts**

*  Class name (e.g. ``BlogController``)
*  Directory (default: ``Controller``)
*  Name of the first action (default: ``index``)

**Files written**

*  ``Classes/Controller/<Name>.php``

**Example output** (``BlogController.php``):

.. code-block:: php

    <?php
    declare(strict_types=1);
    namespace Vendor\Extension\Controller;

    use Psr\Http\Message\ResponseInterface;
    use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

    class BlogController extends ActionController
    {
        public function indexAction(): ResponseInterface
        {
            // Do awesome stuff
            return $this->htmlResponse();
        }
    }

----

.. _cmd-event:

make:event
==========

Creates a **PSR-14 event** class.

.. code-block:: bash

    vendor/bin/typo3 make:event my_extension

**Prompts**

*  Class name (e.g. ``UserRegisteredEvent``)
*  Directory (default: ``Event``)

**Files written**

*  ``Classes/Event/<Name>.php``

**Example output** (``UserRegisteredEvent.php``):

.. code-block:: php

    <?php
    declare(strict_types=1);
    namespace Vendor\Extension\Event;

    final class UserRegisteredEvent
    {
        // Add event properties and constructor here
    }

----

.. _cmd-eventlistener:

make:eventlistener
==================

Creates a **PSR-14 event listener** and registers it in ``Services.yaml``.

.. code-block:: bash

    vendor/bin/typo3 make:eventlistener my_extension

**Prompts**

*  Fully qualified event class name (e.g. ``\\TYPO3\\CMS\\Core\\Mail\\Event\\AfterMailerSentMessageEvent``)
*  Listener class name (auto-proposed from the event name)
*  Directory (default: ``EventListener``)
*  Listener identifier
*  Method name (leave empty to use ``__invoke()``)

**Files written**

*  ``Classes/EventListener/<Name>.php``
*  ``Configuration/Services.yaml`` — ``event.listener`` tag added

**Example output** (``AfterMailerSentMessageEventListener.php``):

.. code-block:: php

    <?php
    declare(strict_types=1);
    namespace Vendor\Extension\EventListener;

    use TYPO3\CMS\Core\Mail\Event\AfterMailerSentMessageEvent;

    final class AfterMailerSentMessageEventListener
    {
        public function __invoke(AfterMailerSentMessageEvent $event): void
        {
            // Do awesome stuff
        }
    }

----

.. _cmd-exception:

make:exception
==============

Creates a **PHP exception class**.

.. code-block:: bash

    vendor/bin/typo3 make:exception my_extension

**Prompts**

*  Class name (e.g. ``InvalidArgumentException``)
*  Directory (default: ``Exception``)
*  Parent class to extend (default: ``\\RuntimeException``)

**Files written**

*  ``Classes/Exception/<Name>.php``

**Example output** (``InvalidArgumentException.php``):

.. code-block:: php

    <?php
    declare(strict_types=1);
    namespace Vendor\Extension\Exception;

    class InvalidArgumentException extends \RuntimeException
    {
    }

----

.. _cmd-migration:

make:migration
==============

Creates a **data migration class** for migrating database or configuration data.

.. code-block:: bash

    vendor/bin/typo3 make:migration my_extension

**Prompts**

*  Class name (e.g. ``MigrateUserDataMigration``)
*  Directory (default: ``Migration``)
*  Short description

**Files written**

*  ``Classes/Migration/<Name>.php``

**Example output** (``MigrateUserDataMigration.php``):

.. code-block:: php

    <?php
    declare(strict_types=1);
    namespace Vendor\Extension\Migration;

    use TYPO3\CMS\Core\Database\ConnectionPool;

    /**
     * Migrate user data to new format
     */
    class MigrateUserDataMigration
    {
        public function __construct(
            private readonly ConnectionPool $connectionPool,
        ) {}

        public function migrate(): void
        {
            // Perform data migration here
        }
    }

----

.. _cmd-middleware:

make:middleware
===============

Creates a **PSR-15 middleware** and registers it in ``Configuration/RequestMiddlewares.php``.

.. code-block:: bash

    vendor/bin/typo3 make:middleware my_extension

**Prompts**

*  Class name (e.g. ``PostProcessContent``)
*  Directory (default: ``Middleware``)
*  Middleware identifier
*  Type: ``frontend`` or ``backend`` (default: ``frontend``)
*  Comma-separated list of identifiers this middleware runs **before** (optional)
*  Comma-separated list of identifiers this middleware runs **after** (optional)

**Files written**

*  ``Classes/Middleware/<Name>.php``
*  ``Configuration/RequestMiddlewares.php`` — entry added/updated

**Example output** (``PostProcessContent.php``):

.. code-block:: php

    <?php
    declare(strict_types=1);
    namespace Vendor\Extension\Middleware;

    use Psr\Http\Message\ResponseInterface;
    use Psr\Http\Message\ServerRequestInterface;
    use Psr\Http\Server\MiddlewareInterface;
    use Psr\Http\Server\RequestHandlerInterface;

    class PostProcessContent implements MiddlewareInterface
    {
        public function process(
            ServerRequestInterface $request,
            RequestHandlerInterface $handler,
        ): ResponseInterface {
            // Do awesome stuff
            return $handler->handle($request);
        }
    }

----

.. _cmd-service:

make:service
============

Creates a plain **service class**.

.. code-block:: bash

    vendor/bin/typo3 make:service my_extension

**Prompts**

*  Class name (e.g. ``UserService``)
*  Directory (default: ``Service``)

**Files written**

*  ``Classes/Service/<Name>.php``

**Example output** (``UserService.php``):

.. code-block:: php

    <?php
    declare(strict_types=1);
    namespace Vendor\Extension\Service;

    class UserService
    {
        // Add service methods here
    }

----

.. _cmd-trait:

make:trait
==========

Creates a **PHP trait**.

.. code-block:: bash

    vendor/bin/typo3 make:trait my_extension

**Prompts**

*  Trait name (e.g. ``HasTimestampsTrait``)
*  Directory (default: ``Trait``)

**Files written**

*  ``Classes/Trait/<Name>.php``

**Example output** (``HasTimestampsTrait.php``):

.. code-block:: php

    <?php
    declare(strict_types=1);
    namespace Vendor\Extension\Trait;

    trait HasTimestampsTrait
    {
        // Add trait methods here
    }

----

.. _cmd-upgradewizard:

make:upgradewizard
==================

Creates a TYPO3 **upgrade wizard** implementing ``UpgradeWizardInterface`` and registers
it in ``Services.yaml``.

.. code-block:: bash

    vendor/bin/typo3 make:upgradewizard my_extension

**Prompts**

*  Class name (e.g. ``MigrateSlugUpgradeWizard``)
*  Directory (default: ``UpgradeWizard``)
*  Unique wizard identifier (auto-proposed from the extension key and class name)
*  Human-readable title

**Files written**

*  ``Classes/UpgradeWizard/<Name>.php``
*  ``Configuration/Services.yaml`` — ``typo3.upgrade_wizard`` tag added

**Example output** (``MigrateSlugUpgradeWizard.php``):

.. code-block:: php

    <?php
    declare(strict_types=1);
    namespace Vendor\Extension\UpgradeWizard;

    use TYPO3\CMS\Install\Attribute\UpgradeWizard;
    use TYPO3\CMS\Install\Updates\UpgradeWizardInterface;

    #[UpgradeWizard('vendorExtensionMigrateSlug')]
    class MigrateSlugUpgradeWizard implements UpgradeWizardInterface
    {
        public function getTitle(): string { return 'Migrate page slugs'; }
        public function getDescription(): string { return ''; }
        public function executeUpdate(): bool { return true; }
        public function updateNecessary(): bool { return false; }
        public function getPrerequisites(): array { return []; }
    }

----

.. _cmd-viewhelper:

make:viewhelper
===============

Creates a Fluid **ViewHelper** extending ``AbstractViewHelper``.

.. code-block:: bash

    vendor/bin/typo3 make:viewhelper my_extension

**Prompts**

*  Class name (e.g. ``FormatDateViewHelper``)
*  Directory (default: ``ViewHelpers``)

**Files written**

*  ``Classes/ViewHelpers/<Name>.php``

**Example output** (``FormatDateViewHelper.php``):

.. code-block:: php

    <?php
    declare(strict_types=1);
    namespace Vendor\Extension\ViewHelpers;

    use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
    use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

    class FormatDateViewHelper extends AbstractViewHelper
    {
        public function initializeArguments(): void
        {
            // $this->registerArgument('name', 'string', 'Description', true);
        }

        public static function renderStatic(
            array $arguments,
            \Closure $renderChildrenClosure,
            RenderingContextInterface $renderingContext,
        ): string {
            // Do awesome stuff
            return '';
        }
    }
