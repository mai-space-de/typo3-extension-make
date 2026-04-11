.. include:: /Includes.rst.txt

.. _introduction:

============
Introduction
============

**Maispace Make** is an extended TYPO3 kickstarter CLI tool, based on `b13/make
<https://github.com/b13/make>`__, that lets you scaffold PHP components for your TYPO3
extensions directly from the command line — no more copy-pasting boilerplate.

All commands are interactive: they ask for the class name, target directory, and any
additional details they need. You can pre-fill answers via :ref:`environment-variables`
to use the commands in automated workflows.

.. _available-commands:

Available Commands
==================

.. list-table::
   :header-rows: 1
   :widths: 35 65

   * - Command
     - What it generates
   * - :ref:`cmd-backendcontroller`
     - Backend controller + ``Configuration/Backend/Routes.php`` + ``Services.yaml`` tag
   * - :ref:`cmd-command`
     - Symfony console command + ``Services.yaml`` tag
   * - :ref:`cmd-controller`
     - Extbase ``ActionController``
   * - :ref:`cmd-event`
     - PSR-14 event class
   * - :ref:`cmd-eventlistener`
     - PSR-14 event listener + ``Services.yaml`` tag
   * - :ref:`cmd-exception`
     - PHP exception class (configurable parent)
   * - :ref:`cmd-migration`
     - Data migration class
   * - :ref:`cmd-middleware`
     - PSR-15 middleware + ``Configuration/RequestMiddlewares.php`` entry
   * - :ref:`cmd-service`
     - Plain service class
   * - :ref:`cmd-trait`
     - PHP trait
   * - :ref:`cmd-upgradewizard`
     - TYPO3 upgrade wizard + ``Services.yaml`` tag
   * - :ref:`cmd-viewhelper`
     - Fluid ``AbstractViewHelper``

Architecture
============

Each command follows the same pattern:

#. A **Component class** (``Classes/Component/``) holds the state that was collected via
   the prompts and is responsible for generating the PHP file content using a code template
   from ``Resources/Private/CodeTemplates/``.
#. A **Command class** (``Classes/Command/Component/``) extends ``SimpleComponentCommand``,
   presents interactive prompts, builds the component object, writes the generated file, and
   optionally updates ``Configuration/Services.yaml`` or ``Configuration/RequestMiddlewares.php``.
#. **IO helpers** (``Classes/IO/``) handle reading and writing of the service configuration
   (YAML) and array configurations (PHP ``return []`` files) in a safe, incremental way.

Based on `b13/make <https://github.com/b13/make>`__
=====================================================

This extension is a fork/extension of the excellent `b13/make
<https://github.com/b13/make>`__ package. It retains all original commands and adds new
ones for the component types most commonly needed in real-world TYPO3 extensions.
