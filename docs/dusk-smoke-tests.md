# Browser Smoke Tests (Laravel Dusk)

A generic browser smoke crawler that visits every active named GET route as a real
Chrome browser and fails on browser-side errors that PHPUnit feature tests miss
(JS console errors, browser alerts, server-rendered `.alert-danger`, HTTP 500s).

Recipe source: `~/Files_Folder/38903.frameworks/docs/laravel-dusk-smoke-install.md`.

## What it covers

`tests/Browser/SmokeTest.php` has 5 `#[Test]` methods:

| Method | Routes crawled |
|---|---|
| `admin_index_routes_smoke_pass`  | `admin.*.index` |
| `admin_show_routes_smoke_pass`   | `admin.*.show` (first record id substituted) |
| `admin_edit_routes_smoke_pass`   | `admin.*.edit` (first record id substituted) |
| `admin_create_routes_smoke_pass` | `admin.*.create` |
| `frontend_routes_smoke_pass`     | `frontend.*` (parameterless) |

For each route it loads the page, waits ~1.2s for JS, then fails on: an unexpected
browser `alert()`, any SEVERE console error, or a rendered `.alert-danger`. Failures
are aggregated and reported together (not stop-on-first).

## How to run

```bash
cphp artisan dusk                                          # full suite
cphp artisan dusk --filter=frontend_routes_smoke_pass      # one method
```

Run it after frontend changes (Blade/JS/CSS/forms/routes), large refactors, or
dependency/framework upgrades. It is slow (~1–1.5s/route), so prefer it post-change
or nightly rather than on every commit.

## Project-specific setup (how this install differs from the generic recipe)

- **DB / URL**: runs against the live Herd vhost + dev database. `.env.dusk.local`
  is a copy of `.env` (so DB credentials match the served app) with only
  `APP_ENV=dusk.local` and `APP_URL=http://l_conference-management-system.test`
  overridden. **The dusk DB is the live dev DB — never run `migrate:fresh` under
  `--env=dusk.local`.** The crawler is read-only.
- **`phpunit.dusk.xml`**: required. The default `phpunit.xml` forces
  `APP_ENV=testing` + `SESSION_DRIVER=array`, which would (a) make Dusk load
  `.env.testing` (the empty `l_test` DB) and (b) break real-browser logins. The
  Dusk config sets `APP_ENV=dusk.local` and leaves the session driver as `file`.
- **Admin user**: this app keys authorization on `users.role_id` (a single
  `belongsTo role()`, not the generic `belongsToMany roles()`), and every gate in
  `AuthServiceProvider` treats `role_id = 1` as Admin. Role titles are localized
  (`Διαχειριστής`), so `getAdminUser()` matches on `role_id = 1`, not the title.
- **No skipped permission/role routes**: unlike the generic template, Admin
  (role_id 1) has full `role_*` gate access and there is no permissions resource,
  so `admin.roles.*` are crawled normally.
- **Ignored console noise**: `/uploads/` 404s are filtered (old conference media
  not synced to dev machines). This does not mask 500s.

## Files

- `tests/Browser/SmokeTest.php` — the crawler
- `tests/DuskTestCase.php` — stock Dusk base case
- `phpunit.dusk.xml` — Dusk test config (`APP_ENV=dusk.local`)
- `.env.dusk.local` — gitignored; copy of `.env` with env/url overrides

## Bugs surfaced and resolved (2026-06-14)

The first full run flagged 7 admin routes returning genuine HTTP 500s (pre-existing
app bugs from the Laravel 12 upgrade, not test artifacts). All resolved:

**Fixed** — legacy `{{ $x->y or '' }}` Blade syntax (removed in Laravel 6+) was
evaluating the property on a null relation. Replaced with the null-safe operator:

| Route | View | Fix |
|---|---|---|
| `admin.papers.show` | `admin/papers/show.blade.php:37` | `$paper->user?->name` |
| `admin.users.show` | `admin/users/show.blade.php:455` | `$paper->session?->title` |
| `admin.messages.show` | `admin/messages/show.blade.php:54` | `$message->paper?->title` |

**Disabled** in `routes/web.php` — broken/unused actions, registered out of the
resource:

| Route(s) | Change |
|---|---|
| `admin.availabilities.index`, `.show` | `Route::resource('availabilities', …)->except(['index', 'show'])` — both blades read null relations (`index.blade.php:60`, `show.blade.php:29`); create/edit kept |
| `admin.activitylogs.create` (+ `store`) | `…->except(['create', 'store'])` — log viewer, controller has no `create()`/`store()` |
| `admin.loguseragents.create` (+ `store`) | `…->except(['create', 'store'])` — same |

Because the sidebar and the colors/rooms show pages link to the disabled
availabilities routes, those references are guarded with
`@if(Route::has('admin.availabilities.{index,show}'))` so they degrade gracefully
(self-healing if the routes are ever re-enabled):
`partials/sidebar.blade.php`, `admin/colors/show.blade.php`, `admin/rooms/show.blade.php`.

**Result**: full suite green — 5 passed, 70 routes OK, 2 skipped (empty `ContentTag`).

## Known non-blocking advisory

CKEditor 4.5.4 is outdated and logs a SEVERE "this version is not secure" console
advisory on every rich-text form. It is filtered via `ignoredConsolePatterns`
(`'version is not secure'`) so it does not fail the suite, but the editor should be
upgraded as a dependency task.
