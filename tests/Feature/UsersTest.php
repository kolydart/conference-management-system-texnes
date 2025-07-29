<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    var $Model = '\App\User';
    var $table = 'users';
    var $role = 'Διαχειριστής'; // role_id = 1
    var $route_path = "admin.users";

    /** @test */
    public function user_can_index_model(){

        $user = $this->login_user($this->role);

        $instance = \App\User::factory()->count(5)->create();

        $response = $this->get(route("$this->route_path.index"));
        $response->assertSessionHasNoErrors();
        $response->assertSuccessful();

    }

    /** @test */
    public function user_can_view_a_model(){

        $user = $this->login_user($this->role);

        $instance = \App\User::factory()->create();

        $response = $this->get(route("$this->route_path.show", $instance));
        $response->assertSessionHasNoErrors();
        $response->assertSuccessful();

    }

    /** @test */
    public function user_can_store_a_model(){

        $user = $this->login_user($this->role);

        $instance = \App\User::factory()->make();

        $initialCount = \App\User::count(); // Count existing users
        $response = $this->post(route("$this->route_path.store"), $instance->toArray());
        $this->assertDatabaseCount($this->table, $initialCount + 1); // Initial + new user

        $response->assertSessionHasNoErrors();
    }

    /** @test */
    public function user_can_edit_a_model(){

        $user = $this->login_user($this->role);

        $instance = \App\User::factory()->create();

        $response = $this->get(route("$this->route_path.edit", $instance));
        $response->assertSessionHasNoErrors();
        $response->assertSuccessful();

    }

    /** @test */
    public function user_can_update_a_model(){

        $user = $this->login_user($this->role);

        $instance = \App\User::factory()->create();
        $updateData = $instance->toArray();
        
        $response = $this->put(route("$this->route_path.update", $instance), $updateData);

        $this->assertDatabaseHas($this->table, [
            'id' => $instance->id,
            'name' => $updateData['name'],
            'email' => $updateData['email']
        ]);
        $response->assertSessionHasNoErrors();
    }

    /** @test */
    public function user_can_delete_a_model(){

        $user = $this->login_user($this->role);

        $instance = \App\User::factory()->create();

        $response = $this->delete(route("$this->route_path.destroy", $instance));

        $this->assertModelSoftDeleted($instance);

        $response->assertSessionHasNoErrors();
    }
}