.. include:: /Includes.rst.txt

.. _environment-variables:

=====================
Environment Variables
=====================

All environment variables are prefixed with ``MAKE_``. You can set them in your shell
or in a ``.env`` file to pre-fill command prompts and skip interactive questions — useful
for CI pipelines or project-specific defaults.

General
=======

.. list-table::
   :header-rows: 1
   :widths: 40 60

   * - Variable
     - Description
   * - ``MAKE_EXTENSION_KEY``
     - Extension key to use. Skips the interactive extension selection prompt.

make:backendcontroller
======================

.. list-table::
   :header-rows: 1
   :widths: 40 20 40

   * - Variable
     - Default
     - Description
   * - ``MAKE_BACKEND_CONTROLLER_DIR``
     - ``Backend/Controller``
     - Directory for the generated controller class.
   * - ``MAKE_BACKEND_CONTROLLER_PREFIX``
     - *(extension key)*
     - Prefix used when proposing the route identifier.

make:command
============

.. list-table::
   :header-rows: 1
   :widths: 40 20 40

   * - Variable
     - Default
     - Description
   * - ``MAKE_COMMAND_DIR``
     - ``Command``
     - Directory for the generated command class.
   * - ``MAKE_COMMAND_NAME_PREFIX``
     - *(extension key)*
     - Prefix used when proposing the CLI command name (e.g. ``my-ext:``).

make:dataprocessor
==================

.. list-table::
   :header-rows: 1
   :widths: 40 20 40

   * - Variable
     - Default
     - Description
   * - ``MAKE_DATA_PROCESSOR_DIR``
     - ``DataProcessing``
     - Directory for the generated data processor class.

make:dto
========

.. list-table::
   :header-rows: 1
   :widths: 40 20 40

   * - Variable
     - Default
     - Description
   * - ``MAKE_DTO_DIR``
     - ``Dto``
     - Directory for the generated DTO class.

make:enum
=========

.. list-table::
   :header-rows: 1
   :widths: 40 20 40

   * - Variable
     - Default
     - Description
   * - ``MAKE_ENUM_DIR``
     - ``Enum``
     - Directory for the generated enum.
   * - ``MAKE_ENUM_BACKING_TYPE``
     - ``string``
     - Backing type: ``string``, ``int``, or ``none`` (pure enum).

make:factory
============

.. list-table::
   :header-rows: 1
   :widths: 40 20 40

   * - Variable
     - Default
     - Description
   * - ``MAKE_FACTORY_DIR``
     - ``Factory``
     - Directory for the generated factory class.

make:hook
=========

.. list-table::
   :header-rows: 1
   :widths: 40 20 40

   * - Variable
     - Default
     - Description
   * - ``MAKE_HOOK_DIR``
     - ``Hook``
     - Directory for the generated hook class.

make:controller
===============

.. list-table::
   :header-rows: 1
   :widths: 40 20 40

   * - Variable
     - Default
     - Description
   * - ``MAKE_CONTROLLER_DIR``
     - ``Controller``
     - Directory for the generated controller class.
   * - ``MAKE_CONTROLLER_ACTION``
     - ``index``
     - Name of the first action method.

make:event
==========

.. list-table::
   :header-rows: 1
   :widths: 40 20 40

   * - Variable
     - Default
     - Description
   * - ``MAKE_EVENT_DIR``
     - ``Event``
     - Directory for the generated event class.

make:eventlistener
==================

.. list-table::
   :header-rows: 1
   :widths: 40 20 40

   * - Variable
     - Default
     - Description
   * - ``MAKE_EVENT_LISTENER_DIR``
     - ``EventListener``
     - Directory for the generated listener class.
   * - ``MAKE_EVENT_LISTENER_IDENTIFIER_PREFIX``
     - *(package prefix)*
     - Prefix used when proposing the listener identifier.

make:exception
==============

.. list-table::
   :header-rows: 1
   :widths: 40 20 40

   * - Variable
     - Default
     - Description
   * - ``MAKE_EXCEPTION_DIR``
     - ``Exception``
     - Directory for the generated exception class.
   * - ``MAKE_EXCEPTION_PARENT``
     - ``\\RuntimeException``
     - Fully qualified parent class.

make:interface
==============

.. list-table::
   :header-rows: 1
   :widths: 40 20 40

   * - Variable
     - Default
     - Description
   * - ``MAKE_INTERFACE_DIR``
     - *(empty)*
     - Directory for the generated interface. Leave empty to place it directly under ``Classes/``.

make:migration
==============

.. list-table::
   :header-rows: 1
   :widths: 40 20 40

   * - Variable
     - Default
     - Description
   * - ``MAKE_MIGRATION_DIR``
     - ``Migration``
     - Directory for the generated migration class.
   * - ``MAKE_MIGRATION_DESCRIPTION``
     - *(empty)*
     - Short description written into the class docblock.

make:middleware
===============

.. list-table::
   :header-rows: 1
   :widths: 40 20 40

   * - Variable
     - Default
     - Description
   * - ``MAKE_MIDDLEWARE_DIR``
     - ``Middleware``
     - Directory for the generated middleware class.
   * - ``MAKE_MIDDLEWARE_IDENTIFIER_PREFIX``
     - *(package prefix)*
     - Prefix used when proposing the middleware identifier.
   * - ``MAKE_MIDDLEWARE_TYPE``
     - ``frontend``
     - Middleware stack: ``frontend`` or ``backend``.

make:model
==========

.. list-table::
   :header-rows: 1
   :widths: 40 20 40

   * - Variable
     - Default
     - Description
   * - ``MAKE_MODEL_DIR``
     - ``Domain/Model``
     - Directory for the generated model class.

make:repository
===============

.. list-table::
   :header-rows: 1
   :widths: 40 20 40

   * - Variable
     - Default
     - Description
   * - ``MAKE_REPOSITORY_DIR``
     - ``Domain/Repository``
     - Directory for the generated repository class.

make:routeenhancer
==================

.. list-table::
   :header-rows: 1
   :widths: 40 20 40

   * - Variable
     - Default
     - Description
   * - ``MAKE_ROUTE_ENHANCER_DIR``
     - ``Routing/Enhancer``
     - Directory for the generated route enhancer class.

make:service
============

.. list-table::
   :header-rows: 1
   :widths: 40 20 40

   * - Variable
     - Default
     - Description
   * - ``MAKE_SERVICE_DIR``
     - ``Service``
     - Directory for the generated service class.

make:trait
==========

.. list-table::
   :header-rows: 1
   :widths: 40 20 40

   * - Variable
     - Default
     - Description
   * - ``MAKE_TRAIT_DIR``
     - ``Trait``
     - Directory for the generated trait.

make:typeconverter
==================

.. list-table::
   :header-rows: 1
   :widths: 40 20 40

   * - Variable
     - Default
     - Description
   * - ``MAKE_TYPE_CONVERTER_DIR``
     - ``Property/TypeConverter``
     - Directory for the generated type converter class.

make:upgradewizard
==================

.. list-table::
   :header-rows: 1
   :widths: 40 20 40

   * - Variable
     - Default
     - Description
   * - ``MAKE_UPGRADE_WIZARD_DIR``
     - ``UpgradeWizard``
     - Directory for the generated wizard class.
   * - ``MAKE_UPGRADE_WIZARD_PREFIX``
     - *(extension key)*
     - Extension key prefix used when auto-proposing the wizard identifier.
   * - ``MAKE_UPGRADE_WIZARD_TITLE``
     - *(class name)*
     - Human-readable title returned by ``getTitle()``.

make:utility
============

.. list-table::
   :header-rows: 1
   :widths: 40 20 40

   * - Variable
     - Default
     - Description
   * - ``MAKE_UTILITY_DIR``
     - ``Utility``
     - Directory for the generated utility class.

make:validator
==============

.. list-table::
   :header-rows: 1
   :widths: 40 20 40

   * - Variable
     - Default
     - Description
   * - ``MAKE_VALIDATOR_DIR``
     - ``Validator``
     - Directory for the generated validator class.

make:viewhelper
===============

.. list-table::
   :header-rows: 1
   :widths: 40 20 40

   * - Variable
     - Default
     - Description
   * - ``MAKE_VIEWHELPER_DIR``
     - ``ViewHelpers``
     - Directory for the generated ViewHelper class.

Usage Example
=============

.. code-block:: bash

    export MAKE_EXTENSION_KEY=my_extension
    export MAKE_CONTROLLER_DIR=Controller
    export MAKE_CONTROLLER_ACTION=list
    vendor/bin/typo3 make:controller
