## Scaffolding Commands

| Command | What it creates | Auto-updates config |
|---|---|---|
| `make:backendcontroller` | Backend controller (PSR-7 response) | `Configuration/Backend/Routes.php` + `Services.yaml` |
| `make:command` | Symfony console command | `Services.yaml` (`console.command` tag) |
| `make:controller` | Extbase `ActionController` | — |
| `make:dataprocessor` | `DataProcessorInterface` implementation | — |
| `make:dto` | `final class` Data Transfer Object | — |
| `make:enum` | PHP enum (string-, int-backed, or pure) | — |
| `make:event` | `final class` PSR-14 event | — |
| `make:eventlistener` | PSR-14 event listener | `Services.yaml` (`event.listener` tag) |
| `make:exception` | PHP exception class (configurable parent) | — |
| `make:factory` | Factory class | — |
| `make:hook` | TYPO3 hook class | — |
| `make:interface` | PHP interface | — |
| `make:migration` | Data migration class with `ConnectionPool` | — |
| `make:middleware` | PSR-15 `MiddlewareInterface` implementation | `Configuration/RequestMiddlewares.php` |
| `make:model` | Extbase `AbstractEntity` domain model | — |
| `make:repository` | Extbase `Repository` | — |
| `make:routeenhancer` | `EnhancerInterface` site-route enhancer | — |
| `make:service` | Service class | — |
| `make:trait` | PHP trait | — |
| `make:typeconverter` | Extbase `AbstractTypeConverter` | — |
| `make:upgradewizard` | TYPO3 upgrade wizard with `#[UpgradeWizard]` attribute | `Services.yaml` (`typo3.upgrade_wizard` tag) |
| `make:utility` | Utility class | — |
| `make:validator` | Extbase `AbstractValidator` | — |
| `make:viewhelper` | Fluid `AbstractViewHelper` with `renderStatic()` | — |

## Interactive Workflow

Every command:

1. Resolves the target extension interactively, via CLI argument, or via `MAKE_EXTENSION_KEY` env var
2. Prompts for class name, output directory, and any component-specific options
3. Writes a pre-filled PHP file from a code template into the correct directory
4. Optionally initialises and updates `Services.yaml` and/or PHP array config files

## IO Layer

* `ServiceConfiguration` — reads/writes `Configuration/Services.yaml` via Symfony YAML
* `ArrayConfiguration` — reads/writes PHP `return []` array config files (routes, middlewares)
* Both layers auto-create the target file with sensible defaults when it does not exist yet

## Environment Variables

All 34 `MAKE_*` environment variables allow non-interactive scaffolding in automated workflows.
See `Documentation/EnvironmentVariables.rst` or `README.md` for the full reference.
