# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Build & Quality Commands

```bash
# Install dependencies
composer install

# Static analysis (level max)
./vendor/bin/phpstan analyse

# Code style check (PSR-12 + Slevomat)
./vendor/bin/phpcs

# Auto-fix code style
./vendor/bin/phpcbf

# Run tests (no tests exist yet)
./vendor/bin/phpunit
```

## Architecture

This is a TYPO3 CMS extension (`ms_pricing`) that provides a dynamic pricing comparison table.

**Namespace:** `MarekSkopal\MsPricing`

### Key Components

- **PricingController** (`Classes/Controller/`) - Extbase controller with `tableAction()` to render the pricing table
- **Domain Models** (`Classes/Domain/Model/`) - `Plan`, `Feature`, `FeatureGroup`, `PlanFeature`
- **Repositories** (`Classes/Domain/Repository/`) - `PlanRepository`, `FeatureRepository`, `FeatureGroupRepository`
- **CellValueViewHelper** (`Classes/ViewHelper/`) - Renders ✓, –, or text per cell based on `PlanFeature->getValueType()`

### Data Flow

1. `tableAction()` loads plans (with inline plan_features), feature groups, and features
2. Builds a lookup `[featureUid][planUid] => PlanFeature` and a `$groups` array grouped by `FeatureGroup`
3. Fluid template renders a `<table>` with a monthly/yearly toggle powered by `Pricing.js`

### Configuration

TypoScript Sets (TYPO3 13+) are in `Configuration/Sets/MsPricing/`. Optional settings:

```typoscript
plugin.tx_mspricing.settings.currency = $
```

## Requirements

- PHP 8.3+
- TYPO3 13.4+ or 14.1+

## Code Style

- Strict types enabled in all files
- **No constructor property promotion in Extbase domain models** — TYPO3 Extbase hydrates models by setting protected properties directly (bypassing the constructor), so properties must be declared classically with default values
- PHPStan level `max` with bleeding edge; `method.internalClass` ignored globally (needed for `getUid()` on Extbase entities)
- PSR-12 with Slevomat Coding Standard