# Laravel 10 → 12 Upgrade

**Date:** 2026-06-14
**Result:** Laravel `v12.62.0` on PHP `8.2.31`. All 35 tests pass; app serves HTTP 200; `composer audit` clean.

## Why a double jump (10 → 12, skipping 11)

`roave/security-advisories: dev-latest` permanently conflicts with Laravel 11: the
`illuminate/mail` advisory was fixed only in `12.60+` / `13.10+`, with **no patched
release in the 11.x line**. As of June 2026, Laravel 11 is past its security window, so
the advisory will not be backported. Targeting 12 lands on a security-supported,
roave-clean version. The fix is present from `laravel/framework v12.60.0`; we are on
`v12.62.0`.

## kolydart/laravel resolution (path repository)

The published `kolydart/laravel` versions (≤ 1.3) cap at `laravel/framework ^11`, so none
can satisfy `^12`. The local development copy
(`/Users/kolydart/myDocuments/Code/kolydart-laravel`, `master`) declares
`^10.0|^11.0|^12.0`.

To resolve against it, `composer.json` adds a **path repository** with `symlink: true`
and requires `kolydart/laravel: @dev`. `vendor/kolydart/laravel` is therefore a symlink to
the dev copy.

> **Deploy / CI caveat:** `@dev` + path repo only resolves where that local path exists.
> Before deploying, publish a `^12`-capable tag (e.g. `1.4`) of kolydart/laravel to
> Packagist, then change the constraint to `^1.4` and remove the path repository.

## Dependency changes (`composer.json`)

| Package | Before | After |
|---|---|---|
| laravel/framework | ^10.0 | ^12.0 |
| kolydart/laravel | ^0.20.0 | @dev (path repo, symlink) |
| laravel/tinker | ^2.5 | ^2.9 |
| laravel/ui | ^4.0 | ^4.5 |
| sentry/sentry-laravel | ^3.0 | ^4.0 |
| spatie/laravel-activitylog | ^4.0 | ^4.8 |
| spatie/laravel-medialibrary | ^10.0 | ^11.0 |
| unisharp/laravel-filemanager | ^2.0 | ^2.9 |
| yajra/laravel-datatables-oracle | ^10.0 | ^12.0 |
| barryvdh/laravel-debugbar (dev) | ^3.7 | ^3.10 |
| barryvdh/laravel-ide-helper (dev) | ^2.8 | ^3.0 |
| laravel/dusk (dev) | ^7.0 | ^8.0 |
| nunomaduro/collision (dev) | ^7.0 | ^8.1 |
| phpunit/phpunit (dev) | ^10.0 | ^11.5 |
| spatie/laravel-ignition (dev) | ^2.0 | ^2.4 |

PHPUnit had to go to `^11.5` because L12's `collision ^8.6` requires it.

## Breaking-change audit (clean)

- **Floating-point / unsigned column types** — no `float`/`double`/`unsigned*` migration
  calls with the removed `$total`/`$places` args.
- **Doctrine DBAL** — no usage in `app/` or `config/`. `doctrine/dbal ^3.0` is still
  required but is now optional and may be removed in a later cleanup.
- **Carbon 3** (`3.12.1` installed) — no `diffIn*` usages in `app/`, so the
  signed/float return-value change does not affect application code.
- **Sanctum** — not installed (auth via `laravel/ui`); no Sanctum migration/config steps.
- **Application structure** — kept the Laravel 10 structure (`app/Http/Kernel.php`,
  `app/Console/Kernel.php`, classic `bootstrap/app.php`), which Laravel 12 fully supports.

## Open follow-ups

1. **Publish kolydart/laravel `1.4`** and switch the constraint to `^1.4`, dropping the
   path repository — required for clean CI/production installs.
2. **PHPUnit attributes** — test methods still use `/** @test */` docblocks, deprecated in
   PHPUnit 11 and **removed in PHPUnit 12**. Migrate to `#[Test]` before any PHPUnit 12
   bump.
3. **`->change()` migrations** — several legacy migrations call `->change()` (e.g.
   `2019_01_12_130610_update_papers_fields_length`,
   `2025_07_30_105247_update_media_table_for_spatie_v9`). From Laravel 11, `change()`
   drops any column modifiers not re-declared. Production columns are unaffected (these
   already ran under L10), and fresh rebuilds pass the test suite, but re-verify modifiers
   if these tables are ever rebuilt from scratch.
4. **doctrine/dbal** — safe to remove from `composer.json` now that the framework no
   longer needs it.
