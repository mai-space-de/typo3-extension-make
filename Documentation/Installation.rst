.. include:: /Includes.rst.txt

.. _installation:

============
Installation
============

Requirements
============

*  PHP **8.2** or later
*  TYPO3 CMS **13.4** LTS

Composer Installation
=====================

Run the following command in your TYPO3 project root:

.. code-block:: bash

    composer require maispace/make

The extension is activated automatically when installed via Composer.

Verify Installation
===================

After installation, list the available ``make:*`` commands to verify everything is
working:

.. code-block:: bash

    vendor/bin/typo3 list make

You should see output similar to:

.. code-block:: text

    Available commands for the "make" namespace:
      make:backendcontroller  Create a backend controller
      make:command            Create a console command
      make:controller         Create an Extbase action controller
      make:event              Create a PSR-14 event class
      make:eventlistener      Create a PSR-14 event listener
      make:exception          Create a PHP exception class
      make:migration          Create a data migration class
      make:middleware         Create a PSR-15 middleware
      make:service            Create a service class
      make:trait              Create a PHP trait
      make:upgradewizard      Create a TYPO3 upgrade wizard
      make:viewhelper         Create a Fluid ViewHelper
