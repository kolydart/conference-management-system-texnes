<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var string plural lowercase kebab-case
     * @example (users|papers); admin.(users|papers).index for User|Paper model
     */
    static $route_particle = 'users';

    /**
     * @var string plural lowercase snake_case
     * usually equal to self::$route_particle
     * differs on multi-word models
     */
    static $view_particle = 'users';

    var $Model = '\App\User';
    var $table = 'users';
    var $role = 'Admin';
    var $route_path = "admin.users";


    /** @test */
    public function user_can_index_model(){
        $this->seed_default_data();
        $user = $this->login_user($this->role);

        $instance = $this->Model::factory(5)->create();

        $response = $this->get(route("$this->route_path.index"));
        $response->assertSessionHasNoErrors();
        $response->assertSuccessful();

    }

    /** @test */
    public function user_can_view_a_model(){
        $this->seed_default_data();
        $user = $this->login_user($this->role);

        $instance = $this->Model::factory()->create();

        $response = $this->get(route("$this->route_path.show", $instance));
        $response->assertSessionHasNoErrors();
        $response->assertSuccessful();

    }

    /** @test */
    public function user_can_store_a_model(){
        $this->seed_default_data();
        $user = $this->login_user($this->role);

        $instance = $this->Model::factory()->make();

        $this->assertDatabaseCount($this->table, 1); // Only the logged in user
        $response = $this->post(route("$this->route_path.store"), $instance->toArray());
        $this->assertDatabaseCount($this->table, 2); // Logged in user + new user

        $response->assertSessionHasNoErrors();
    }

    /** @test */
    public function user_can_edit_a_model(){
        $this->seed_default_data();
        $user = $this->login_user($this->role);

        $instance = $this->Model::factory()->create();

        $response = $this->get(route("$this->route_path.edit", $instance));
        $response->assertSessionHasNoErrors();
        $response->assertSuccessful();

    }

    /** @test */
    public function user_can_update_a_model(){
        $this->seed_default_data();
        $user = $this->login_user($this->role);

        $instance = $this->Model::factory()->create();

        $response = $this->put(route("$this->route_path.update", $instance), $instance->toArray());

        $freshInstance = $instance->fresh();

        $instanceAttrs = array_filter($instance->getAttributes());
        $freshAttrs = array_filter($freshInstance->getAttributes());

        unset($instanceAttrs['updated_at'], $freshAttrs['updated_at']);

        $this->assertEquals($instanceAttrs, $freshAttrs);
        $this->assertDatabaseCount($this->table, 2); // Logged in user + updated user
        $response->assertSessionHasNoErrors();
    }

    /** @test */
    public function user_can_delete_a_model(){
        $this->seed_default_data();
        $user = $this->login_user($this->role);

        $instance = $this->Model::factory()->create();

        $response = $this->delete(route("$this->route_path.destroy", $instance));

        $this->assertDatabaseMissing($this->table, ['id' => $instance->id]);

        $response->assertSessionHasNoErrors();
    }
}