.. include:: /Includes.rst.txt

.. _changelog:

=========
Changelog
=========

1.0.0 (2026-03-12)
==================

Initial Release
---------------

*  Based on `b13/make <https://github.com/b13/make>`__ — all original commands are
   included (``make:backendcontroller``, ``make:command``, ``make:eventlistener``,
   ``make:middleware``).

*  **New commands:**

   *  ``make:controller`` — Extbase ``ActionController``
   *  ``make:event`` — PSR-14 event class
   *  ``make:exception`` — PHP exception class with configurable parent
   *  ``make:migration`` — Data migration class
   *  ``make:service`` — Plain service class
   *  ``make:trait`` — PHP trait
   *  ``make:upgradewizard`` — TYPO3 upgrade wizard (``UpgradeWizardInterface``)
   *  ``make:viewhelper`` — Fluid ``AbstractViewHelper``

*  **Code templates** for all component types in ``Resources/Private/CodeTemplates/``.

*  **Unit tests** — 104 tests covering file-content generation, namespace/class-name
   computation, identifier proposals, and service/array configuration output.

*  **CI pipeline** — GitHub Actions: composer validate, unit tests (PHP 8.2 + 8.3 ×
   TYPO3 13.4), PHPStan (max level), PHP-CS-Fixer, EditorConfig check.

*  **Environment variables** — all ``MAKE_*`` variables documented in
   :ref:`environment-variables`.
