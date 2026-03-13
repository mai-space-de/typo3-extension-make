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

.. _cmd-dataprocessor:

make:dataprocessor
==================

Creates a **TypoScript data processor** implementing ``DataProcessorInterface``.

.. code-block:: bash

    vendor/bin/typo3 make:dataprocessor my_extension

**Prompts**

*  Class name (e.g. ``MyDataProcessor``)
*  Directory (default: ``DataProcessing``)

**Files written**

*  ``Classes/DataProcessing/<Name>.php``

**Example output** (``MyDataProcessor.php``):

.. code-block:: php

    <?php
    declare(strict_types=1);
    namespace Vendor\Extension\DataProcessing;

    use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
    use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;

    class MyDataProcessor implements DataProcessorInterface
    {
        public function process(
            ContentObjectRenderer $cObj,
            array $contentObjectConfiguration,
            array $processorConfiguration,
            array $processedData,
        ): array {
            // Process data here
            return $processedData;
        }
    }

.. note::

   Reference the processor in TypoScript with:
   ``10 = Vendor\Extension\DataProcessing\MyDataProcessor``

----

.. _cmd-dto:

make:dto
========

Creates a **Data Transfer Object** (DTO) as a ``final`` class.

.. code-block:: bash

    vendor/bin/typo3 make:dto my_extension

**Prompts**

*  Class name (e.g. ``UserDto``)
*  Directory (default: ``Dto``)

**Files written**

*  ``Classes/Dto/<Name>.php``

**Example output** (``UserDto.php``):

.. code-block:: php

    <?php
    declare(strict_types=1);
    namespace Vendor\Extension\Dto;

    final class UserDto
    {
        public function __construct(
            // Add readonly properties here
        ) {}
    }

----

.. _cmd-enum:

make:enum
=========

Creates a **PHP enum** (backed by ``string``, ``int``, or pure).

.. code-block:: bash

    vendor/bin/typo3 make:enum my_extension

**Prompts**

*  Backing type (``string`` / ``int`` / ``none``, default: ``string``)
*  Class name (e.g. ``Status``)
*  Directory (default: ``Enum``)

**Files written**

*  ``Classes/Enum/<Name>.php``

**Example output** (``Status.php`` with string backing):

.. code-block:: php

    <?php
    declare(strict_types=1);
    namespace Vendor\Extension\Enum;

    enum Status: string
    {
        // Add enum cases here
    }

----

.. _cmd-factory:

make:factory
============

Creates a **factory class** for constructing domain objects.

.. code-block:: bash

    vendor/bin/typo3 make:factory my_extension

**Prompts**

*  Class name (e.g. ``UserFactory``)
*  Directory (default: ``Factory``)

**Files written**

*  ``Classes/Factory/<Name>.php``

----

.. _cmd-hook:

make:hook
=========

Creates a **TYPO3 hook class**.

.. code-block:: bash

    vendor/bin/typo3 make:hook my_extension

**Prompts**

*  Class name (e.g. ``PageHook``)
*  Directory (default: ``Hook``)

**Files written**

*  ``Classes/Hook/<Name>.php``

.. warning::

   Hooks are deprecated since TYPO3 v10 and will be removed in future versions.
   Prefer PSR-14 events via ``make:event`` / ``make:eventlistener`` where possible.

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

.. _cmd-interface:

make:interface
==============

Creates a **PHP interface**.

.. code-block:: bash

    vendor/bin/typo3 make:interface my_extension

**Prompts**

*  Interface name (e.g. ``UserRepositoryInterface``)
*  Directory (leave empty to place the interface directly under ``Classes/``)

**Files written**

*  ``Classes/<Directory>/<Name>.php``

**Example output** (``UserRepositoryInterface.php``):

.. code-block:: php

    <?php
    declare(strict_types=1);
    namespace Vendor\Extension\Domain\Repository;

    interface UserRepositoryInterface
    {
        // Add interface methods here
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

.. _cmd-model:

make:model
==========

Creates an **Extbase domain model** extending ``AbstractEntity``.

.. code-block:: bash

    vendor/bin/typo3 make:model my_extension

**Prompts**

*  Class name (e.g. ``BlogPost``)
*  Directory (default: ``Domain/Model``)

**Files written**

*  ``Classes/Domain/Model/<Name>.php``

**Example output** (``BlogPost.php``):

.. code-block:: php

    <?php
    declare(strict_types=1);
    namespace Vendor\Extension\Domain\Model;

    use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

    class BlogPost extends AbstractEntity
    {
        // Add model properties here
    }

----

.. _cmd-repository:

make:repository
===============

Creates an **Extbase domain repository** extending ``Repository``.

.. code-block:: bash

    vendor/bin/typo3 make:repository my_extension

**Prompts**

*  Class name (e.g. ``BlogPostRepository``)
*  Directory (default: ``Domain/Repository``)

**Files written**

*  ``Classes/Domain/Repository/<Name>.php``

**Example output** (``BlogPostRepository.php``):

.. code-block:: php

    <?php
    declare(strict_types=1);
    namespace Vendor\Extension\Domain\Repository;

    use TYPO3\CMS\Extbase\Persistence\Repository;

    class BlogPostRepository extends Repository
    {
    }

----

.. _cmd-routeenhancer:

make:routeenhancer
==================

Creates a **custom site-route enhancer** implementing ``EnhancerInterface``.

.. code-block:: bash

    vendor/bin/typo3 make:routeenhancer my_extension

**Prompts**

*  Class name (e.g. ``BlogRouteEnhancer``)
*  Directory (default: ``Routing/Enhancer``)

**Files written**

*  ``Classes/Routing/Enhancer/<Name>.php``

**Example output** (``BlogRouteEnhancer.php``):

.. code-block:: php

    <?php
    declare(strict_types=1);
    namespace Vendor\Extension\Routing\Enhancer;

    use TYPO3\CMS\Core\Routing\Enhancer\EnhancerInterface;
    use TYPO3\CMS\Core\Routing\RouteCollection;

    class BlogRouteEnhancer implements EnhancerInterface
    {
        public function __construct(protected readonly array $configuration = []) {}

        public function enhanceForMatching(RouteCollection $collection): void
        {
            // Add custom routes to the collection
        }

        public function enhanceForGeneration(RouteCollection $collection, array $originalParameters): void
        {
            // Enhance routes for URL generation
        }
    }

.. note::

   Register the enhancer in ``ext_localconf.php``::

       $GLOBALS['TYPO3_CONF_VARS']['SYS']['routing']['enhancers']['MyEnhancer']
           = \Vendor\Extension\Routing\Enhancer\BlogRouteEnhancer::class;

   Then reference it by type in your site configuration YAML.

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

.. _cmd-utility:

make:utility
============

Creates a **utility class** for grouping related static or stateless helper methods.

.. code-block:: bash

    vendor/bin/typo3 make:utility my_extension

**Prompts**

*  Class name (e.g. ``StringUtility``)
*  Directory (default: ``Utility``)

**Files written**

*  ``Classes/Utility/<Name>.php``

----

.. _cmd-validator:

make:validator
==============

Creates an **Extbase validator** extending ``AbstractValidator``.

.. code-block:: bash

    vendor/bin/typo3 make:validator my_extension

**Prompts**

*  Class name (e.g. ``NotEmptyValidator``)
*  Directory (default: ``Validator``)

**Files written**

*  ``Classes/Validator/<Name>.php``

**Example output** (``NotEmptyValidator.php``):

.. code-block:: php

    <?php
    declare(strict_types=1);
    namespace Vendor\Extension\Validator;

    use TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator;

    class NotEmptyValidator extends AbstractValidator
    {
        protected function isValid(mixed $value): void
        {
            // Add validation logic here
            // Use $this->addError('message', 1234567890) to add errors
        }
    }

----

.. _cmd-typeconverter:

make:typeconverter
==================

Creates an **Extbase property type converter** (``PropertyMapper``) extending ``AbstractTypeConverter``.

.. code-block:: bash

    vendor/bin/typo3 make:typeconverter my_extension

**Prompts**

*  Class name (e.g. ``StringToDateTimeConverter``)
*  Directory (default: ``Property/TypeConverter``)

**Files written**

*  ``Classes/Property/TypeConverter/<Name>.php``

**Example output** (``StringToDateTimeConverter.php``):

.. code-block:: php

    <?php
    declare(strict_types=1);
    namespace Vendor\Extension\Property\TypeConverter;

    use TYPO3\CMS\Extbase\Property\PropertyMappingConfigurationInterface;
    use TYPO3\CMS\Extbase\Property\TypeConverter\AbstractTypeConverter;

    class StringToDateTimeConverter extends AbstractTypeConverter
    {
        /**
         * @var array<string>
         */
        protected array $sourceTypes = ['string'];
        protected string $targetType = '';
        protected int $priority = 10;

        public function convertFrom(
            mixed $source,
            string $targetType,
            array $convertedChildProperties = [],
            ?PropertyMappingConfigurationInterface $configuration = null,
        ): mixed {
            // Convert $source to $targetType here
            return null;
        }
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
