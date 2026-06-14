<?php

namespace Tests\Browser;

use App\User;
use Facebook\WebDriver\Exception\NoSuchAlertException;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Laravel\Dusk\Browser;
use PHPUnit\Framework\Attributes\Test;
use Tests\DuskTestCase;

/**
 * Browser smoke crawler.
 *
 * Visits every active named GET route in admin (*.index, *.show, *.edit, *.create)
 * and frontend (*) as a real browser, failing on browser-side errors (alerts,
 * SEVERE console errors, rendered .alert-danger) that PHPUnit feature tests miss.
 *
 * Runs against the live Herd vhost + dev database (see .env.dusk.local). Records
 * are read from that DB, so it is read-only: no DatabaseMigrations/Transactions
 * traits and never migrate:fresh against it.
 */
class SmokeTest extends DuskTestCase
{
    /** Route names to exclude (logout, destructive ops, framework internals). */
    protected array $skipNames = [
        'auth.logout',
        'debugbar.assets.js',
        'debugbar.assets.css',
        'debugbar.openhandler',
        'ignition.healthCheck',
        'dusk.login',
        'dusk.logout',
        'dusk.user',
        // NOTE: this project's Admin (role_id 1) has full role_* gate access and
        // has no permissions resource, so admin.roles.* / admin.permissions.* are
        // intentionally NOT skipped (unlike the generic template).
    ];

    /** URI prefixes that are not page endpoints. */
    protected array $skipUriPrefixes = [
        '_ignition', '_debugbar', '_dusk', '_boost',
        'livewire/', 'sanctum/', 'api/', 'storage/',
        'oauth/', 'horizon/', 'telescope/',
    ];

    /** Console messages that are ignored (noisy / 3rd-party). */
    protected array $ignoredConsolePatterns = [
        'favicon.ico',
        'chrome-extension://',
        'DevTools',
        // Missing uploaded media (e.g. old conference assets not synced to this
        // dev machine) 404s are environmental noise, not code regressions. This
        // does NOT mask 500s — those URLs don't contain '/uploads/'.
        '/uploads/',
        // CKEditor 4.5.4 logs a SEVERE "this version is not secure" advisory on
        // every rich-text form. Noise for smoke purposes (tracked as a dependency
        // upgrade); narrow match so genuine CKEditor errors still surface.
        'version is not secure',
    ];

    #[Test]
    public function admin_index_routes_smoke_pass(): void
    {
        $admin = $this->getAdminUser();

        $routes = $this->discoverRoutes(fn ($name) => Str::is('admin.*.index', $name));

        $this->assertNotEmpty($routes, 'No admin *.index routes discovered.');

        $failures = [];

        $this->browse(function (Browser $browser) use ($admin, $routes, &$failures) {
            $browser->loginAs($admin->id);

            foreach ($routes as $route) {
                $error = $this->visitAndCollect($browser, $route);
                if ($error !== null) {
                    $failures[] = $error;
                }
            }
        });

        $this->assertEmpty(
            $failures,
            count($failures)." admin route(s) failed:\n\n".implode("\n\n", $failures)
        );
    }

    #[Test]
    public function admin_show_routes_smoke_pass(): void
    {
        $admin = $this->getAdminUser();

        $routes = $this->discoverRoutes(fn ($name) => Str::is('admin.*.show', $name), allowParameters: true);

        $this->assertNotEmpty($routes, 'No admin *.show routes discovered.');

        $failures = [];

        $this->browse(function (Browser $browser) use ($admin, $routes, &$failures) {
            $browser->loginAs($admin->id);

            foreach ($routes as $route) {
                $uri = $this->resolveUri($route);
                if ($uri === null) {
                    continue;
                }

                $error = $this->visitUri($browser, $route->getName(), $uri);
                if ($error !== null) {
                    $failures[] = $error;
                }
            }
        });

        $this->assertEmpty(
            $failures,
            count($failures)." admin show route(s) failed:\n\n".implode("\n\n", $failures)
        );
    }

    #[Test]
    public function admin_edit_routes_smoke_pass(): void
    {
        $admin = $this->getAdminUser();

        $routes = $this->discoverRoutes(fn ($name) => Str::is('admin.*.edit', $name), allowParameters: true);

        $this->assertNotEmpty($routes, 'No admin *.edit routes discovered.');

        $failures = [];

        $this->browse(function (Browser $browser) use ($admin, $routes, &$failures) {
            $browser->loginAs($admin->id);

            foreach ($routes as $route) {
                $uri = $this->resolveUri($route);
                if ($uri === null) {
                    continue;
                }

                $error = $this->visitUri($browser, $route->getName(), $uri);
                if ($error !== null) {
                    $failures[] = $error;
                }
            }
        });

        $this->assertEmpty(
            $failures,
            count($failures)." admin edit route(s) failed:\n\n".implode("\n\n", $failures)
        );
    }

    #[Test]
    public function admin_create_routes_smoke_pass(): void
    {
        $admin = $this->getAdminUser();

        $routes = $this->discoverRoutes(fn ($name) => Str::is('admin.*.create', $name));

        $this->assertNotEmpty($routes, 'No admin *.create routes discovered.');

        $failures = [];

        $this->browse(function (Browser $browser) use ($admin, $routes, &$failures) {
            $browser->loginAs($admin->id);

            foreach ($routes as $route) {
                $error = $this->visitAndCollect($browser, $route);
                if ($error !== null) {
                    $failures[] = $error;
                }
            }
        });

        $this->assertEmpty(
            $failures,
            count($failures)." admin create route(s) failed:\n\n".implode("\n\n", $failures)
        );
    }

    #[Test]
    public function frontend_routes_smoke_pass(): void
    {
        $routes = $this->discoverRoutes(fn ($name) => Str::startsWith($name, 'frontend.'));

        if ($routes->isEmpty()) {
            $this->markTestSkipped('No frontend routes discovered.');
        }

        $failures = [];

        $this->browse(function (Browser $browser) use ($routes, &$failures) {
            foreach ($routes as $route) {
                $error = $this->visitAndCollect($browser, $route);
                if ($error !== null) {
                    $failures[] = $error;
                }
            }
        });

        $this->assertEmpty(
            $failures,
            count($failures)." frontend route(s) failed:\n\n".implode("\n\n", $failures)
        );
    }

    protected function discoverRoutes(callable $nameMatcher, bool $allowParameters = false): \Illuminate\Support\Collection
    {
        return collect(Route::getRoutes())
            ->filter(fn ($r) => in_array('GET', $r->methods(), true))
            ->filter(fn ($r) => $r->getName() !== null)
            ->filter(fn ($r) => $nameMatcher($r->getName()))
            ->filter(fn ($r) => $allowParameters || ! str_contains($r->uri(), '{'))
            ->filter(fn ($r) => ! in_array($r->getName(), $this->skipNames, true))
            ->filter(fn ($r) => ! Str::startsWith($r->uri(), $this->skipUriPrefixes))
            ->values();
    }

    /**
     * Resolve a parametrized admin route URI by substituting the first record's key.
     * Returns null when the model class is missing or the table is empty (skip, not failure).
     */
    protected function resolveUri(RoutingRoute $route): ?string
    {
        $name = $route->getName();
        $segments = explode('.', $name);

        if (count($segments) < 3) {
            return null;
        }

        $resource = $segments[1];
        $class = 'App\\'.Str::studly(Str::singular($resource));

        if (! class_exists($class)) {
            fwrite(STDOUT, "  → {$name} ({$route->uri()}) ... skipped (no model {$class})\n");
            return null;
        }

        $record = $class::first();

        if (! $record) {
            fwrite(STDOUT, "  → {$name} ({$route->uri()}) ... skipped (no record in ".class_basename($class).")\n");
            return null;
        }

        $uri = preg_replace('/\{[^}]+\}/', (string) $record->getKey(), $route->uri(), 1);

        return '/'.ltrim($uri, '/');
    }

    /** Returns an error message string on failure, or null on success. */
    protected function visitAndCollect(Browser $browser, RoutingRoute $route): ?string
    {
        return $this->visitUri($browser, $route->getName(), '/'.ltrim($route->uri(), '/'));
    }

    /** Visits an absolute URI and runs the smoke assertions. */
    protected function visitUri(Browser $browser, string $name, string $uri): ?string
    {
        fwrite(STDOUT, "  → {$name} ({$uri}) ... ");

        try {
            $browser->visit($uri)->pause(1200);
        } catch (\Throwable $e) {
            fwrite(STDOUT, "ERROR\n");

            return "Route {$name} ({$uri}): visit threw ".get_class($e).': '.$e->getMessage();
        }

        // 1. Browser-level alert (DataTables warnings, custom JS alerts)
        try {
            $alertText = $browser->driver->switchTo()->alert()->getText();
            $browser->driver->switchTo()->alert()->accept();
            $browser->driver->manage()->getLog('browser'); // drain so logs don't leak to next route

            return "Route {$name} ({$uri}): unexpected browser alert: {$alertText}";
        } catch (NoSuchAlertException $e) {
            // expected — no alert
        }

        // 2. Console SEVERE errors
        $logs = collect($browser->driver->manage()->getLog('browser'))
            ->where('level', 'SEVERE')
            ->reject(function ($entry) {
                foreach ($this->ignoredConsolePatterns as $pattern) {
                    if (Str::contains($entry['message'] ?? '', $pattern)) {
                        return true;
                    }
                }
                return false;
            })
            ->values();

        if ($logs->isNotEmpty()) {
            fwrite(STDOUT, "FAIL (console errors)\n");

            return "Route {$name} ({$uri}): console errors:\n  - ".$logs->pluck('message')->implode("\n  - ");
        }

        // 3. Rendered server-error indicators
        try {
            $browser->assertMissing('.alert-danger');
        } catch (\Throwable $e) {
            fwrite(STDOUT, "FAIL (.alert-danger)\n");

            return "Route {$name} ({$uri}): rendered .alert-danger on page";
        }

        fwrite(STDOUT, "ok\n");

        return null;
    }

    /** The Admin role id (hardcoded in AuthServiceProvider gates as the admin identifier). */
    protected int $adminRoleId = 1;

    /**
     * Resolve an Admin user.
     *
     * This project keys authorization on users.role_id (a single belongsTo role()
     * relation, not the generic belongsToMany roles()), and every gate in
     * AuthServiceProvider treats role_id 1 as Admin. The role title is localized
     * (e.g. 'Διαχειριστής'), so we match on the id rather than the title.
     */
    protected function getAdminUser(): User
    {
        $admin = User::where('role_id', $this->adminRoleId)->first();

        if (! $admin) {
            $this->fail('No Admin user (role_id '.$this->adminRoleId.') found in dusk database (.env.dusk.local → l_texnes_conference).');
        }

        return $admin;
    }
}
