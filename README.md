# Pricing Table for TYPO3 CMS

Dynamic pricing comparison table as a content element in TYPO3. Plans, features, and cell values are managed in the TYPO3 backend; the frontend renders a responsive table with a monthly/yearly price toggle.

## Features

- Pricing plans with monthly and yearly prices
- Feature rows grouped by feature groups
- Per-cell value types: available (✓), unavailable (–), or custom text
- Monthly/yearly toggle with no page reload
- Highlighted plan column
- Optional tooltip per feature (via description field)
- Customizable templates and styling

## Example

Live example: [fingather.com/pricing](https://www.fingather.com/pricing)

## Requirements

- PHP 8.3+
- TYPO3 13.4 or 14.x

## Installation

```bash
composer require marekskopal/typo3-pricing
```

After installation, run the database analyser in the TYPO3 Install Tool to create the required tables.

## Setup

Include the TypoScript Set **Pricing** in your site package or via the site configuration sets.

### Available Settings

| Setting | Default | Description |
|---------|---------|-------------|
| `settings.currency` | `$` | Currency symbol displayed before prices |
| `view.templateRootPath` | *(extension default)* | Override template root path |
| `view.partialRootPath` | *(extension default)* | Override partial root path |
| `view.layoutRootPath` | *(extension default)* | Override layout root path |

## Backend Setup

Create records in this order:

1. **Feature Groups** — optional section headers (e.g. "Limits", "Integrations")
2. **Features** — individual table rows; assign a feature group if desired
3. **Plans** — pricing columns (name, subtitle, monthly/yearly price, currency, highlighted flag)
   For each plan, add **Plan Feature** inline records that link a feature to a value type:
   - `available` — renders a checkmark
   - `unavailable` — renders a dash (default when no record exists)
   - `text` — renders a custom string (e.g. "20", "Unlimited", "Email")

## Usage

Add the **Pricing Table** content element to a page. The table is rendered automatically from the backend records.

## Customization

### Templates

Override templates by setting custom paths in TypoScript:

```typoscript
plugin.tx_mspricing.view.templateRootPath = EXT:your_extension/Resources/Private/Templates/MsPricing/
```

### Styling

The extension includes minimal CSS. Key classes:

| Class | Element |
|-------|---------|
| `.mspricing-toggle` | Monthly/yearly toggle container |
| `.mspricing-toggle__button--active` | Active toggle button |
| `.mspricing-table` | The `<table>` element |
| `.mspricing-plan` | Plan header cell (`<th>`) |
| `.mspricing-plan--highlighted` | Highlighted plan column |
| `.mspricing-plan__name` | Plan name |
| `.mspricing-plan__subtitle` | Plan subtitle |
| `.mspricing-plan__price` | Price element |
| `.mspricing-group-header` | Feature group header row |
| `.mspricing-feature__name` | Feature name cell |
| `.mspricing-cell` | Value cell |
| `.mspricing-cell--highlighted` | Value cell in highlighted column |
| `.mspricing-check` | Checkmark SVG icon |

## License

GPL-2.0-or-later
