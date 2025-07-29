<?php

namespace Tests\Feature;

use App\Session;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SessionsTest extends TestCase
{
    use RefreshDatabase;

    var $Model = '\App\Session';
    var $table = 'sessions';
    var $role = 'Διαχειριστής';
    var $route_path = "admin.sessions";

    /** @test */
    public function user_can_index_model(){

        $this->seed_default_data();
        $user = $this->login_user($this->role);

        $instance = factory(\App\Session::class, 5)->create();

        $response = $this->get(route("$this->route_path.index"));
        $response->assertSessionHasNoErrors();
        $response->assertSuccessful();

    }

    /** @test */
    public function user_can_view_a_model(){

        $this->seed_default_data();
        $user = $this->login_user($this->role);

        $instance = factory(\App\Session::class)->create();

        $response = $this->get(route("$this->route_path.show", $instance));
        $response->assertSessionHasNoErrors();
        $response->assertSuccessful();

    }

    /** @test */
    public function user_can_store_a_model(){

        $this->seed_default_data();
        $user = $this->login_user($this->role);

        $instance = factory(\App\Session::class)->make();

        $this->assertDatabaseCount($this->table, 0);
        $response = $this->post(route("$this->route_path.store"), $instance->toArray());
        $this->assertDatabaseCount($this->table, 1);

        $response->assertSessionHasNoErrors();
    }

    /** @test */
    public function user_can_edit_a_model(){

        $this->seed_default_data();
        $user = $this->login_user($this->role);

        $instance = factory(\App\Session::class)->create();

        $response = $this->get(route("$this->route_path.edit", $instance));
        $response->assertSessionHasNoErrors();
        $response->assertSuccessful();

    }

    /** @test */
    public function user_can_update_a_model(){

        $this->seed_default_data();
        $user = $this->login_user($this->role);

        $instance = factory(\App\Session::class)->create();
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

        $instance = factory(\App\Session::class)->create();

        $response = $this->delete(route("$this->route_path.destroy", $instance));

        $this->assertModelSoftDeleted($instance);

        $response->assertSessionHasNoErrors();
    }
}