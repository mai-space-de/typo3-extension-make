## 1. Generator Catalogue

24 `make:*` commands scaffold PHP components from the TYPO3 CLI. Five of them also auto-update
configuration files; the remaining 19 only write a PHP class file.

| Command | PHP class created | Config auto-updated |
|---|---|---|
| `make:backendcontroller` | PSR-7 backend controller | `Configuration/Backend/Routes.php` + `Services.yaml` |
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

---

## 2. Generators With Configuration Side-Effects

These five generators write a PHP file **and** update one or more configuration files.
All collision checks prompt the user before overwriting an existing entry.

### make:backendcontroller

**Prompts:** class name (required) · output directory (default: `Backend/Controller`) · route
identifier (default: `ext-key.ClassName`) · route path (default: `/module/ext-key/class-name`) ·
handler method (leave empty → `__invoke()`)

**Creates:**
- `Classes/<dir>/<Name>.php` — PSR-7 controller that receives a `ServerRequestInterface` and
  returns a `ResponseInterface` via injected `ResponseFactoryInterface` and `StreamFactoryInterface`
- Entry in `Configuration/Backend/Routes.php` — `['path' => '...', 'target' => 'FQN', 'access' => 'admin']`
- Service tag in `Configuration/Services.yaml` — `TYPO3\CMS\Backend\Attribute\AsController`

**Collision guard:** if the route identifier already exists in `Routes.php`, the command asks
whether to override before writing.

---

### make:command

**Prompts:** class name (required) · output directory (default: `Command`) · CLI command name
(default: `ext-key:class-name`) · description (required) · schedulable? (yes/no, default: no)

**Creates:**
- `Classes/<dir>/<Name>.php` — Symfony `Command` subclass with `configure()` and `execute()`
- Service tag in `Configuration/Services.yaml` — `console.command` with optional
  `schedulable: true` when confirmed

---

### make:eventlistener

**Prompts:** event FQN (required) · listener class name (auto-derived from FQN) · output directory
(default: `EventListener`) · service identifier (default: `ext-key/listener-name`) · handler
method (leave empty → `__invoke()`)

**Creates:**
- `Classes/<dir>/<Name>.php` — `final class` with a typed handler method that receives the event
- Service tag in `Configuration/Services.yaml` — `event.listener` with `event`, `identifier`,
  and `method`

---

### make:middleware

**Prompts:** class name (required) · output directory (default: `Middleware`) · service identifier
(default: `ext-key/middleware-name`) · type (choice: `frontend` / `backend`, default: `frontend`) ·
before (comma-separated middleware identifiers, optional) · after (comma-separated middleware
identifiers, optional)

**Creates:**
- `Classes/<dir>/<Name>.php` — implements `MiddlewareInterface` with a `process()` method that
  delegates to `$handler->handle($request)` by default
- Entry in `Configuration/RequestMiddlewares.php` — nested under `frontend` or `backend` with the
  class reference plus optional `before` and `after` arrays

**Collision guard:** if the identifier already exists for the chosen type, the command asks whether
to override.

---

### make:upgradewizard

**Prompts:** class name (required) · output directory (default: `UpgradeWizard`) · unique identifier
(default: `ext_key.WizardName`) · human-readable title

**Creates:**
- `Classes/<dir>/<Name>.php` — implements `UpgradeWizardInterface` with the PHP 8 attribute
  `#[UpgradeWizard('identifier')]` and all required interface methods stubbed
- Service tag in `Configuration/Services.yaml` — `typo3.upgrade_wizard`

---

## 3. Pure PHP Generators

These 19 generators write exactly one PHP class file and do not touch any configuration.
All follow the same prompt sequence: class name (required) → output directory (default shown below).

| Command | Default directory | Base class / interface | Notes |
|---|---|---|---|
| `make:controller` | `Controller` | `ActionController` | Prompts for first action name (default: `index`) |
| `make:dataprocessor` | `DataProcessing` | `DataProcessorInterface` | Implements `process()` |
| `make:dto` | `Dto` | *(none — `final class`)* | Pure value object |
| `make:enum` | `Enum` | *(PHP enum)* | Prompts for backing type: `string` / `int` / `none` |
| `make:event` | `Event` | *(none — `final class`)* | PSR-14 event; properties/constructor are stubs |
| `make:exception` | `Exception` | `\RuntimeException` | Prompts for parent class (default: `\RuntimeException`) |
| `make:factory` | `Factory` | *(none)* | Empty factory class |
| `make:hook` | `Hook` | *(none)* | TYPO3 signal/hook receiver |
| `make:interface` | *(root of `Classes/`)* | *(PHP interface)* | Empty interface |
| `make:migration` | `Migration` | *(none)* | Injects `ConnectionPool` for direct SQL migrations |
| `make:model` | `Domain/Model` | `AbstractEntity` | Empty Extbase domain model |
| `make:repository` | `Domain/Repository` | `Repository` | Empty Extbase repository |
| `make:routeenhancer` | `Routing/Enhancer` | `EnhancerInterface` | Site-route enhancer stub |
| `make:service` | `Service` | *(none)* | Empty service class |
| `make:trait` | `Trait` | *(PHP trait)* | Empty trait |
| `make:typeconverter` | `Property/TypeConverter` | `AbstractTypeConverter` | Extbase property mapper |
| `make:utility` | `Utility` | *(none)* | Static utility class |
| `make:validator` | `Validator` | `AbstractValidator` | Extbase field validator |
| `make:viewhelper` | `ViewHelpers` | `AbstractViewHelper` | Includes `initializeArguments()` and static `renderStatic()` |

---

## 4. Extension Resolution

Every command resolves the target extension through a three-step priority chain:

1. **CLI argument** — `vendor/bin/typo3 make:controller my_extension`
2. **`MAKE_EXTENSION_KEY` environment variable** — set once per shell session; the command skips
   the selection prompt and uses it directly
3. **Interactive selection** — the command lists all installed TYPO3 extensions as choices
   (filtered to `type: typo3-cms-extension`; `mai_make` itself is excluded)

The PSR-4 prefix for the generated namespace is read from the target extension's `composer.json`
(`autoload.psr-4` first key). The extension's package path determines where files are written.

---

## 5. Interactive Workflow

For every generated file:

1. **Extension resolved** (see section 4)
2. **Component-specific prompts** — class name, directory, and any command-specific options
3. **File collision check** — if the target file already exists, the command asks whether to
   override before writing
4. **Config side-effect** — if applicable (see section 2), the command updates configuration files
5. **`Services.yaml` auto-creation** — if a config command needs `Services.yaml` and it does not
   exist yet, the command offers to create a basic DI scaffold:
   ```yaml
   services:
     _defaults:
       autowire: true
       autoconfigure: true
       public: false
     Vendor\ExtKey\:
       resource: '../Classes/*'
       exclude: '../Classes/Domain/Model/*'
   ```
6. **Cache flush reminder** — a note is printed after every successful generation reminding the
   developer to flush the TYPO3 cache

---

## 6. IO Layer

### ServiceConfiguration

Reads and writes `Configuration/Services.yaml` using Symfony YAML.

- Loaded lazily on first access; returns `[]` for a missing or invalid file
- `imports:` keys are sorted to the top of the written YAML to keep the canonical structure
- New service tags are deep-merged into the existing `services:` map so existing entries are not
  removed
- `createBasicServiceConfiguration()` seeds the file with autowire/autoconfigure defaults and
  a namespace wildcard loader when the file does not exist yet

### ArrayConfiguration

Reads and writes PHP `return []` array config files (e.g. `Routes.php`, `RequestMiddlewares.php`).

- File and directory are configurable at construction time
- Loaded via `require`; returns `[]` for a missing file
- Written as a formatted PHP array literal using TYPO3's `ArrayUtility::arrayExport()`
- Missing parent directories are created automatically with `GeneralUtility::mkdir_deep()`
- Notifies the developer when the target file does not exist yet (it will be created)

---

## 7. Code Template System

Every generator resolves its output from a static template in
`Resources/Private/CodeTemplates/<Type>.php`. Templates use `{{PLACEHOLDER}}` tokens that are
replaced at render time by each component's `__toString()` method via a `preg_replace_callback`.

Common tokens across all templates:

| Token | Value |
|---|---|
| `{{NAMESPACE}}` | Fully-qualified PHP namespace (PSR-4 prefix + directory) |
| `{{NAME}}` | Class name (ucfirst, stripped of path separators) |

Command-specific tokens (examples):

| Token | Used in | Value |
|---|---|---|
| `{{ACTION_NAME}}` | `Controller.php` | First action method name |
| `{{METHOD}}` | `BackendController.php`, `EventListener.php` | Handler method name |
| `{{EVENT}}` | `EventListener.php` | Fully-qualified event class name |
| `{{DESCRIPTION}}` | `Command.php` | CLI command description string |
| `{{IDENTIFIER}}` | `UpgradeWizard.php` | Upgrade wizard unique identifier |
| `{{TITLE}}` | `UpgradeWizard.php` | Human-readable wizard title |

Unknown tokens are left verbatim in the output (the pattern returns the original match when no
replacement is found).

---

## 8. Environment Variables

All 34 `MAKE_*` environment variables allow non-interactive scaffolding in CI or shell scripts.
Set any variable before running a `make:*` command to skip the corresponding prompt.

| Variable | Affects | Default when absent |
|---|---|---|
| `MAKE_EXTENSION_KEY` | all commands — extension selection | interactive choice |
| `MAKE_CONTROLLER_DIR` | `make:controller` — output directory | `Controller` |
| `MAKE_CONTROLLER_ACTION` | `make:controller` — first action name | `index` |
| `MAKE_EVENT_DIR` | `make:event` — output directory | `Event` |
| `MAKE_EVENT_LISTENER_DIR` | `make:eventlistener` — output directory | `EventListener` |
| `MAKE_EVENT_LISTENER_IDENTIFIER_PREFIX` | `make:eventlistener` — identifier prefix | package prefix |
| `MAKE_EXCEPTION_DIR` | `make:exception` — output directory | `Exception` |
| `MAKE_EXCEPTION_PARENT` | `make:exception` — parent class | `\RuntimeException` |
| `MAKE_MIGRATION_DIR` | `make:migration` — output directory | `Migration` |
| `MAKE_MIGRATION_DESCRIPTION` | `make:migration` — description comment | *(empty)* |
| `MAKE_MIDDLEWARE_DIR` | `make:middleware` — output directory | `Middleware` |
| `MAKE_MIDDLEWARE_IDENTIFIER_PREFIX` | `make:middleware` — identifier prefix | package prefix |
| `MAKE_MIDDLEWARE_TYPE` | `make:middleware` — frontend or backend | `frontend` |
| `MAKE_SERVICE_DIR` | `make:service` — output directory | `Service` |
| `MAKE_TRAIT_DIR` | `make:trait` — output directory | `Trait` |
| `MAKE_UPGRADE_WIZARD_DIR` | `make:upgradewizard` — output directory | `UpgradeWizard` |
| `MAKE_UPGRADE_WIZARD_PREFIX` | `make:upgradewizard` — identifier prefix | extension key |
| `MAKE_UPGRADE_WIZARD_TITLE` | `make:upgradewizard` — human-readable title | *(empty)* |
| `MAKE_VIEWHELPER_DIR` | `make:viewhelper` — output directory | `ViewHelpers` |
| `MAKE_BACKEND_CONTROLLER_DIR` | `make:backendcontroller` — output directory | `Backend/Controller` |
| `MAKE_BACKEND_CONTROLLER_PREFIX` | `make:backendcontroller` — route identifier prefix | extension key |
| `MAKE_COMMAND_DIR` | `make:command` — output directory | `Command` |
| `MAKE_COMMAND_NAME_PREFIX` | `make:command` — CLI command name prefix | extension key |
| `MAKE_INTERFACE_DIR` | `make:interface` — output directory | *(root of `Classes/`)* |
| `MAKE_MODEL_DIR` | `make:model` — output directory | `Domain/Model` |
| `MAKE_REPOSITORY_DIR` | `make:repository` — output directory | `Domain/Repository` |
| `MAKE_DATA_PROCESSOR_DIR` | `make:dataprocessor` — output directory | `DataProcessing` |
| `MAKE_DTO_DIR` | `make:dto` — output directory | `Dto` |
| `MAKE_ENUM_DIR` | `make:enum` — output directory | `Enum` |
| `MAKE_ENUM_BACKING_TYPE` | `make:enum` — backing type (`string`/`int`/`none`) | `string` |
| `MAKE_FACTORY_DIR` | `make:factory` — output directory | `Factory` |
| `MAKE_HOOK_DIR` | `make:hook` — output directory | `Hook` |
| `MAKE_ROUTE_ENHANCER_DIR` | `make:routeenhancer` — output directory | `Routing/Enhancer` |
| `MAKE_TYPE_CONVERTER_DIR` | `make:typeconverter` — output directory | `Property/TypeConverter` |
| `MAKE_UTILITY_DIR` | `make:utility` — output directory | `Utility` |
| `MAKE_VALIDATOR_DIR` | `make:validator` — output directory | `Validator` |

> Variables are read from both `$_ENV` and `getenv()`. The `MAKE_` prefix is mandatory; the key
> passed to `Variables::get()` / `Variables::has()` must omit the prefix (e.g. pass
> `'EXTENSION_KEY'`, not `'MAKE_EXTENSION_KEY'`).

---

## 9. Architecture Constraints

- **Dev-only dependency** — `mai_make` must appear only in `require-dev` of the consuming
  extension's `composer.json`. Never declare it as a runtime dependency.
- **Self-exclusion** — the interactive extension chooser filters out `mai_make` so it cannot
  scaffold components into its own source tree.
- **No Extbase plugin registration** — `make:controller` and `make:model` do not touch
  `Configuration/Extbase/Persistence/Classes.php` or `ext_localconf.php`. Plugin registration
  remains a manual step.
- **No TCA generation** — no generator produces TCA configuration, `ext_tables.sql`, or FlexForm
  XML. Those are deliberate omissions; use the generated model as the starting point.
- **Forked from b13/make** — this extension extends the upstream `b13/make` generator set with
  additional commands (`make:backendcontroller`, `make:dto`, `make:enum`, `make:event`,
  `make:exception`, `make:factory`, `make:hook`, `make:interface`, `make:migration`,
  `make:routeenhancer`, `make:trait`, `make:typeconverter`, `make:utility`, `make:validator`) and
  adds a full test suite.
- **TYPO3 compatibility** — supports TYPO3 13.4 LTS and 14.x; PHP 8.2+.
