<?php

namespace Tests;

use App\User;
use App\Role;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;

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

    // Legacy methods for backward compatibility
    function signin_as_manager(){
        $user = User::factory()->create(['role_id' => 3]);
        $this->actingAs($user);
        return $user;
    }

    function signin_as_atendee(){
        $user = User::factory()->create(['role_id' => 7]);
        $this->actingAs($user);
        return $user;
    }

    /**
     * Seed basic roles for testing
     */
    public function seed_roles(): void
    {
        $roles = [
            ['id' => 1, 'title' => 'Διαχειριστής'],
            ['id' => 3, 'title' => 'Συντονιστής'],
            ['id' => 4, 'title' => 'Οργανωτική Επιτροπή'],
            ['id' => 5, 'title' => 'Επιστημονική Επιτροπή'],
            ['id' => 6, 'title' => 'Συγγραφέας'],
            ['id' => 7, 'title' => 'Ακροατής'],
            ['id' => 8, 'title' => 'Γραμματεία'],
            ['id' => 9, 'title' => 'Εθελοντής'],
            ['id' => 10, 'title' => 'Επιμελητές Πρακτικών'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }

    /**
     * sign-in user
     * @example $user = $this->login_user();
     * @example $user = $this->login_user('Διαχειριστής');
     */
    public function login_user(string $role_title = 'Ακροατής', array $definition = []): User
    {
        $user = $this->create_user($role_title, $definition);
        $this->actingAs($user);
        return $user;
    }

    /**
     * create user
     * @example $user = $this->create_user('Διαχειριστής');
     */
    public function create_user(string $role_title = 'Ακροατής', array $definition = []): User
    {
        $this->seed_roles();
        
        $role = Role::where('title', $role_title)->first();
        if (!$role) {
            // Fallback to default attendee role
            $role = Role::find(7);
        }

        $userData = array_merge(['role_id' => $role->id], $definition);
        
        $user = User::factory()->create($userData);

        return $user;
    }

    /**
     * Seed default data for testing - adapted to current seeders
     */
    public function seed_default_data(): void
    {
        // Run existing seeders if they exist
        try {
            Artisan::call('db:seed', ['--class' => 'RoleSeed']);
        } catch (\Exception $e) {
            // Fallback to manual seeding if seeder doesn't exist
            $this->seed_roles();
        }
        
        // Seed required data for factories
        $this->seed_colors();
        $this->seed_rooms();
    }

    /**
     * Seed basic colors for testing
     */
    public function seed_colors(): void
    {
        if (!\App\Color::count()) {
            \App\Color::create(['name' => 'Blue', 'value' => '#0000FF']);
            \App\Color::create(['name' => 'Red', 'value' => '#FF0000']);
            \App\Color::create(['name' => 'Green', 'value' => '#00FF00']);
        }
    }

    /**
     * Seed basic rooms for testing
     */
    public function seed_rooms(): void
    {
        if (!\App\Room::count()) {
            \App\Room::create(['name' => 'Room A', 'capacity' => 50]);
            \App\Room::create(['name' => 'Room B', 'capacity' => 30]);
            \App\Room::create(['name' => 'Room C', 'capacity' => 20]);
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
     * Helper for soft delete assertion in Laravel 5.6
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
}
