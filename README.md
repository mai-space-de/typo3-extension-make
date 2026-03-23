# typo3-extension-make

[![CI](https://github.com/mai-space-de/typo3-extension-make/actions/workflows/ci.yml/badge.svg)](https://github.com/mai-space-de/typo3-extension-make/actions/workflows/ci.yml)
[![License: GPL v2+](https://img.shields.io/badge/License-GPL%20v2%2B-blue.svg)](LICENSE)

> Extended TYPO3 make/kickstarter CLI tool — based on [b13/make](https://github.com/b13/make) with tests, linting and additional make commands.

## Overview

This TYPO3 extension provides a collection of `bin/typo3 make:*` commands that let you scaffold PHP components directly from the command line — no more copy-pasting boilerplate code.

| Command | What it creates |
|---|---|
| `make:backendcontroller` | Backend controller (with route registration) |
| `make:command` | Symfony console command |
| `make:controller` | Extbase `ActionController` |
| `make:dataprocessor` | TypoScript data processor |
| `make:dto` | Data Transfer Object (DTO) |
| `make:enum` | PHP enum (string-, int-backed, or pure) |
| `make:event` | PSR-14 event class |
| `make:eventlistener` | PSR-14 event listener (with service configuration) |
| `make:exception` | PHP exception class |
| `make:factory` | Factory class |
| `make:hook` | TYPO3 hook class |
| `make:interface` | PHP interface |
| `make:migration` | Data migration class |
| `make:middleware` | PSR-15 middleware (with `RequestMiddlewares.php` entry) |
| `make:model` | Extbase domain model (`AbstractEntity`) |
| `make:repository` | Extbase domain repository |
| `make:routeenhancer` | Custom site-route enhancer |
| `make:service` | Service class |
| `make:trait` | PHP trait |
| `make:typeconverter` | Extbase property type converter |
| `make:upgradewizard` | TYPO3 upgrade wizard (with service configuration) |
| `make:utility` | Utility class |
| `make:validator` | Extbase validator |
| `make:viewhelper` | Fluid `AbstractViewHelper` |

## Requirements

- PHP **8.2+**
- TYPO3 **13.4+**

## Installation

```bash
composer require maispace/mai-make
```

The extension is active automatically via composer. All commands are available via the TYPO3 CLI:

```bash
vendor/bin/typo3 list make
```

## Usage

Each command is interactive — it will ask you for the class name, directory and any additional information it needs. You can also pre-fill values through environment variables to speed up scaffolding in automated workflows.

### Create a controller

```bash
vendor/bin/typo3 make:controller my_extension
```

Creates an Extbase `ActionController` in `Classes/Controller/`.

### Create a PSR-14 event

```bash
vendor/bin/typo3 make:event my_extension
```

Creates a final event class in `Classes/Event/`.

### Create a PSR-14 event listener

```bash
vendor/bin/typo3 make:eventlistener my_extension
```

Creates an event listener and registers it in `Configuration/Services.yaml`.

### Create an exception

```bash
vendor/bin/typo3 make:exception my_extension
```

Creates a PHP exception class in `Classes/Exception/`.

### Create a middleware

```bash
vendor/bin/typo3 make:middleware my_extension
```

Creates a PSR-15 middleware and adds it to `Configuration/RequestMiddlewares.php`.

### Create a migration

```bash
vendor/bin/typo3 make:migration my_extension
```

Creates a data migration class in `Classes/Migration/`.

### Create a service

```bash
vendor/bin/typo3 make:service my_extension
```

Creates a service class in `Classes/Service/`.

### Create a trait

```bash
vendor/bin/typo3 make:trait my_extension
```

Creates a PHP trait in `Classes/Trait/`.

### Create an upgrade wizard

```bash
vendor/bin/typo3 make:upgradewizard my_extension
```

Creates a TYPO3 upgrade wizard and registers it in `Configuration/Services.yaml`.

### Create a ViewHelper

```bash
vendor/bin/typo3 make:viewhelper my_extension
```

Creates a Fluid `AbstractViewHelper` in `Classes/ViewHelpers/`.

### Create a model

```bash
vendor/bin/typo3 make:model my_extension
```

Creates an Extbase domain model in `Classes/Domain/Model/`.

### Create a repository

```bash
vendor/bin/typo3 make:repository my_extension
```

Creates an Extbase domain repository in `Classes/Domain/Repository/`.

### Create an interface

```bash
vendor/bin/typo3 make:interface my_extension
```

Creates a PHP interface in the selected directory.

### Create a DTO

```bash
vendor/bin/typo3 make:dto my_extension
```

Creates a Data Transfer Object in `Classes/Dto/`.

### Create an enum

```bash
vendor/bin/typo3 make:enum my_extension
```

Creates a PHP enum (string-backed by default) in `Classes/Enum/`.

### Create a factory

```bash
vendor/bin/typo3 make:factory my_extension
```

Creates a factory class in `Classes/Factory/`.

### Create a hook class

```bash
vendor/bin/typo3 make:hook my_extension
```

Creates a TYPO3 hook class in `Classes/Hook/`.

### Create a data processor

```bash
vendor/bin/typo3 make:dataprocessor my_extension
```

Creates a TypoScript `DataProcessorInterface` implementation in `Classes/DataProcessing/`.

### Create a type converter

```bash
vendor/bin/typo3 make:typeconverter my_extension
```

Creates an Extbase property type converter in `Classes/Property/TypeConverter/`.

### Create a route enhancer

```bash
vendor/bin/typo3 make:routeenhancer my_extension
```

Creates a custom site-route enhancer in `Classes/Routing/Enhancer/`.

### Create a utility class

```bash
vendor/bin/typo3 make:utility my_extension
```

Creates a utility class in `Classes/Utility/`.

### Create a validator

```bash
vendor/bin/typo3 make:validator my_extension
```

Creates an Extbase validator in `Classes/Validator/`.

### Create a backend controller

```bash
vendor/bin/typo3 make:backendcontroller my_extension
```

Creates a backend controller, registers it in `Configuration/Backend/Routes.php` and in `Configuration/Services.yaml`.

### Create a console command

```bash
vendor/bin/typo3 make:command my_extension
```

Creates a Symfony console command and registers it in `Configuration/Services.yaml`.

## Environment variables

You can pre-set values so the commands don't ask for them interactively. All variables are prefixed with `MAKE_`.

| Variable | Used by | Default |
|---|---|---|
| `MAKE_EXTENSION_KEY` | all | _(interactive)_ |
| `MAKE_CONTROLLER_DIR` | `make:controller` | `Controller` |
| `MAKE_CONTROLLER_ACTION` | `make:controller` | `index` |
| `MAKE_EVENT_DIR` | `make:event` | `Event` |
| `MAKE_EVENT_LISTENER_DIR` | `make:eventlistener` | `EventListener` |
| `MAKE_EVENT_LISTENER_IDENTIFIER_PREFIX` | `make:eventlistener` | _(package prefix)_ |
| `MAKE_EXCEPTION_DIR` | `make:exception` | `Exception` |
| `MAKE_EXCEPTION_PARENT` | `make:exception` | `\RuntimeException` |
| `MAKE_MIGRATION_DIR` | `make:migration` | `Migration` |
| `MAKE_MIGRATION_DESCRIPTION` | `make:migration` | _(empty)_ |
| `MAKE_MIDDLEWARE_DIR` | `make:middleware` | `Middleware` |
| `MAKE_MIDDLEWARE_IDENTIFIER_PREFIX` | `make:middleware` | _(package prefix)_ |
| `MAKE_MIDDLEWARE_TYPE` | `make:middleware` | `frontend` |
| `MAKE_SERVICE_DIR` | `make:service` | `Service` |
| `MAKE_TRAIT_DIR` | `make:trait` | `Trait` |
| `MAKE_UPGRADE_WIZARD_DIR` | `make:upgradewizard` | `UpgradeWizard` |
| `MAKE_UPGRADE_WIZARD_PREFIX` | `make:upgradewizard` | _(extension key)_ |
| `MAKE_UPGRADE_WIZARD_TITLE` | `make:upgradewizard` | _(class name)_ |
| `MAKE_VIEWHELPER_DIR` | `make:viewhelper` | `ViewHelpers` |
| `MAKE_BACKEND_CONTROLLER_DIR` | `make:backendcontroller` | `Backend/Controller` |
| `MAKE_BACKEND_CONTROLLER_PREFIX` | `make:backendcontroller` | _(extension key)_ |
| `MAKE_COMMAND_DIR` | `make:command` | `Command` |
| `MAKE_COMMAND_NAME_PREFIX` | `make:command` | _(extension key)_ |
| `MAKE_INTERFACE_DIR` | `make:interface` | _(empty)_ |
| `MAKE_MODEL_DIR` | `make:model` | `Domain/Model` |
| `MAKE_REPOSITORY_DIR` | `make:repository` | `Domain/Repository` |
| `MAKE_DATA_PROCESSOR_DIR` | `make:dataprocessor` | `DataProcessing` |
| `MAKE_DTO_DIR` | `make:dto` | `Dto` |
| `MAKE_ENUM_DIR` | `make:enum` | `Enum` |
| `MAKE_ENUM_BACKING_TYPE` | `make:enum` | `string` |
| `MAKE_FACTORY_DIR` | `make:factory` | `Factory` |
| `MAKE_HOOK_DIR` | `make:hook` | `Hook` |
| `MAKE_ROUTE_ENHANCER_DIR` | `make:routeenhancer` | `Routing/Enhancer` |
| `MAKE_TYPE_CONVERTER_DIR` | `make:typeconverter` | `Property/TypeConverter` |
| `MAKE_UTILITY_DIR` | `make:utility` | `Utility` |
| `MAKE_VALIDATOR_DIR` | `make:validator` | `Validator` |

## Development

### Setup

```bash
composer install
```

### Run tests

```bash
composer test:unit
```

### Code style

```bash
# Check
composer lint:check

# Fix
composer lint:fix
```

### PHPStan

```bash
composer check:phpstan
```

## Credits

Based on [b13/make](https://github.com/b13/make) by [b13 GmbH](https://b13.com).

## License

GPL-2.0-or-later — see [LICENSE](LICENSE).
