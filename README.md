# MartinCV Theme

Custom WordPress theme for [martincv.com](https://www.martincv.com/).

## Requirements

- WordPress 6.0+
- PHP 8.0+
- Node 20 (see `.nvmrc`)
- ACF Pro (blocks, options page)

## Setup

```bash
npm install
npm run build
```

Then activate the theme in **Appearance → Themes**. Run the build before activating — block registration and asset enqueues read from `build/`.

## Scripts

| Script | Description |
| --- | --- |
| `npm run start` | Watch mode for theme entries + blocks in parallel |
| `npm run build` | Production build (theme + blocks) |
| `npm run start:theme` / `build:theme` | Theme entries only (`src/*.js` → `build/theme/`) |
| `npm run start:blocks` / `build:blocks` | Blocks only (`blocks/` → `build/blocks/`, PHP templates copied) |

`build/` is committed to the repo.

## Architecture

- **`functions.php`** — constants (`MARTINCV_THEME_*`), theme supports, per-template asset enqueues from `build/theme/*.asset.php`.
- **`inc/`** — namespaced classes (`MartinCV\…`) loaded via `inc/core/autoloader.php`; every class is a singleton (`MartinCV\Traits\Singleton`) booted in `inc/init.php`.
  - `inc/core/class-register-blocks.php` auto-registers every directory in `build/blocks/` via `register_block_type()` and dequeues assets of blocks not present on the page.
  - `inc/sections/` — one data class per ACF block (`set_properties_from_block()` + getters).
- **`blocks/<slug>/`** — ACF block source: `block.json`, `index.js` (imports `style.scss`), `template.php`.
- **`acf-json/`** — ACF Local JSON (field groups with hand-written stable keys).
- **`src/`** — theme entries (`index.js`, `404.js`, `archive.js`, `single.js`), each importing its SCSS; shared TS modules in `src/js/modules/`.
- **`theme.json`** — palette (placeholder colors for now), typography, spacing, breakpoints under `settings.custom.breakpoints`.

## Adding a block

1. Create `blocks/<slug>/` with `block.json` (`"name": "acf/<slug>"`), `index.js`, `style.scss`, `template.php`.
2. Add `inc/sections/class-<slug>-section.php` with fields getters.
3. Add `acf-json/group_<slug>_block.json` with location rule `block == acf/<slug>`.
4. `npm run build` — the block is auto-registered from `build/blocks/<slug>/`.
