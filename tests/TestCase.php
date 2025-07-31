<?php

namespace Tests;

use App\User;
use App\Role;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    /**
     * @var string plural lowercase kebab-case
     * @example (users|papers); admin.(users|papers).index for User|Paper model
     */
    static $route_particle;

    /**
     * @var string plural lowercase snake_case
     * usually equal to self::$route_particle
     * differs on multi-word models
     */
    static $view_particle;

    /**
     * Seed roles - no permissions system in this project, just roles
     * Gates are hardcoded in AuthServiceProvider based on role_id
     */
    public function seed_permissions(): void
    {
        // For this project, we only need to seed roles since Gates are hardcoded
        $this->seed_roles();
    }

    /**
     * sign-in user
     * @example $user = $this->login_user();
     * @example $user = $this->login_user('Admin');
     */
    public function login_user(string $role_title = 'Admin', array $definition = []): User
    {
        $user = $this->create_user($role_title, $definition);
        $this->actingAs($user);
        return $user;
    }

    /**
     * create user
     * @example $user = $this->create_user('Admin');
     */
    public function create_user(string $role_title = 'Admin', array $definition = []): User
    {
        $this->seed_permissions();

        if ($role_title === 'Admin') {
            $role = Role::find(1);
        } else {
            $role = Role::where('title', $role_title)->first();
            if (!$role) {
                // Fallback to Admin role
                $role = Role::find(1);
            }
        }

        // Ensure role exists, create if needed
        if (!$role) {
            $role = Role::create(['id' => 1, 'title' => 'Admin']);
        }

        // Ensure user is approved by default for tests
        $userData = array_merge(['role_id' => $role->id, 'approved' => 1], $definition);

        // Create user using factory but force our role_id to override the closure
        $user = User::factory()->make($userData);
        $user->role_id = $role->id; // Explicitly set role_id to override factory closure
        $user->save();

        // Note: This project doesn't use role()->sync() - roles are assigned via role_id
        // Gates are automatically available via AuthServiceProvider based on role_id

        return $user;
    }

    /**
     * Seed basic roles for testing using the RoleSeed
     */
    public function seed_roles(): void
    {
        $seeder = new \RoleSeed();
        $seeder->run();
    }

    /** consider running it once */
    public function seed_default_data(): void
    {
        // Always seed permissions first
        $this->seed_permissions();

        // Use existing project seeders - adapted for conference management system
        try {
            Artisan::call('db:seed', ['--class' => 'ColorSeed']);
            Artisan::call('db:seed', ['--class' => 'RoomsSeed']);
            // Only seed essential data for tests, not full data
        } catch (\Exception $e) {
            // Fallback to manual seeding if seeders don't exist
            $this->seed_colors();
            $this->seed_rooms();
        }
    }

    /**
     * Seed basic colors for testing
     */
    public function seed_colors(): void
    {
        if (!\App\Color::count()) {
            \App\Color::create(['title' => 'Blue', 'value' => '#0000FF']);
            \App\Color::create(['title' => 'Red', 'value' => '#FF0000']);
            \App\Color::create(['title' => 'Green', 'value' => '#00FF00']);
        }
    }

    /**
     * Seed basic rooms for testing
     */
    public function seed_rooms(): void
    {
        if (!\App\Room::count()) {
            \App\Room::create(['title' => 'Room A', 'capacity' => 50]);
            \App\Room::create(['title' => 'Room B', 'capacity' => 30]);
            \App\Room::create(['title' => 'Room C', 'capacity' => 20]);
        }
    }

    /**
     * custom message on response status
     * @usage in loops
     */
    public function assertResponseStatus($response, $expectedHttpCode, $message = "Response status mismatch")
    {
        $this->assertEquals($expectedHttpCode, $response->getStatusCode(), $message);
    }

    /**
     * custom message on route existence
     * @usage in loops
     */
    public function assertRouteExists($routeName, $message = "Route does not exist")
    {
        $this->assertTrue(\Route::has($routeName), $message);
    }

    /**
     * assertDatabaseCount for Laravel 8 compatibility
     */
    public function assertDatabaseCount($table, int $count, $connection = null)
    {
        $this->assertEquals($count, \DB::connection($connection)->table($table)->count());
    }

    /**
     * Helper for soft delete assertion
     */
    public function assertModelSoftDeleted($model)
    {
        // Check if model uses soft deletes
        $modelClass = get_class($model);
        $usesSoftDeletes = in_array('Illuminate\Database\Eloquent\SoftDeletes', class_uses_recursive($modelClass));

        if ($usesSoftDeletes) {
            $this->assertSoftDeleted($model->getTable(), [
                $model->getKeyName() => $model->getKey(),
            ]);
        } else {
            // For models without soft deletes, just check it's been removed
            $this->assertDatabaseMissing($model->getTable(), [
                $model->getKeyName() => $model->getKey(),
            ]);
        }
    }

    // Legacy methods for backward compatibility
    function signin_as_manager(){
        $user = User::factory()->create(['role_id' => 3, 'approved' => 1]);
        $this->actingAs($user);
        return $user;
    }

    function signin_as_atendee(){
        $user = User::factory()->create(['role_id' => 7, 'approved' => 1]);
        $this->actingAs($user);
        return $user;
    }
}
