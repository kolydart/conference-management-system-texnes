<?php

namespace Tests\Feature;

use App\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RolesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var string plural lowercase kebab-case
     * @example (users|papers); admin.(users|papers).index for User|Paper model
     */
    static $route_particle = 'roles';

    /**
     * @var string plural lowercase snake_case
     * usually equal to self::$route_particle
     * differs on multi-word models
     */
    static $view_particle = 'roles';

    var $Model = '\App\Role';
    var $table = 'roles';
    var $role = 'Admin';
    var $route_path = "admin.roles";

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

        $instance = \App\Role::factory()->create();

        $response = $this->get(route("$this->route_path.show", $instance));
        $response->assertSessionHasNoErrors();
        $response->assertSuccessful();

    }

    /** @test */
    public function user_can_store_a_model(){

        $this->seed_default_data();
        $user = $this->login_user($this->role);

        $instance = \App\Role::factory()->make();

        $initialCount = \App\Role::count(); // Account for seeded roles
        $response = $this->post(route("$this->route_path.store"), $instance->toArray());
        $this->assertDatabaseCount($this->table, $initialCount + 1);

        $response->assertSessionHasNoErrors();
    }

    /** @test */
    public function user_can_edit_a_model(){

        $this->seed_default_data();
        $user = $this->login_user($this->role);

        $instance = \App\Role::factory()->create();

        $response = $this->get(route("$this->route_path.edit", $instance));
        $response->assertSessionHasNoErrors();
        $response->assertSuccessful();

    }

    /** @test */
    public function user_can_update_a_model(){

        $this->seed_default_data();
        $user = $this->login_user($this->role);

        $instance = \App\Role::factory()->create();
        $updateData = $instance->toArray();
        
        $response = $this->put(route("$this->route_path.update", $instance), $updateData);

        $this->assertDatabaseHas($this->table, [
            'id' => $instance->id,
            'title' => $updateData['title']
        ]);
        $response->assertSessionHasNoErrors();
    }

    /** @test */
    public function user_can_delete_a_model(){

        $this->seed_default_data();
        $user = $this->login_user($this->role);

        $instance = \App\Role::factory()->create();

        $response = $this->delete(route("$this->route_path.destroy", $instance));

        $this->assertModelSoftDeleted($instance);

        $response->assertSessionHasNoErrors();
    }
}