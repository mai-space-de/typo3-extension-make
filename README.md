# maispace/mai-make — TYPO3 Extension
[![PHP](https://img.shields.io/badge/PHP-8.2%2B-blue)](https://www.php.net/)
[![TYPO3](https://img.shields.io/badge/TYPO3-13.4%20LTS-orange)](https://typo3.org/)
[![License: GPL v2](https://img.shields.io/badge/License-GPL%20v2-blue.svg)](https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html)

Extended TYPO3 make/kickstarter CLI tool. Adds `make:*` commands for rapid scaffolding. Bundles `helhum/typo3-console` for enhanced CLI capabilities and `cms-t3editor` for in-backend code editing. Development-only — should not be installed in production.

**Requires:** TYPO3 13.4 LTS / 14.0 · PHP 8.2+

---

## Installation

```bash
composer require maispace/mai-make
```

---

## Development

### Linting

```bash
composer lint:check     # Run all linters
composer lint:fix       # Fix auto-fixable issues
```

### Testing

```bash
composer test           # Run all tests
composer test:unit      # Run unit tests only
```

---

## License

GPL-2.0-or-later — see [LICENSE](../../LICENSE) for details.
