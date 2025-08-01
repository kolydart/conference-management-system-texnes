<?php

namespace Tests\Feature;

use App\Room;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoomsTest extends TestCase
{
    use RefreshDatabase;

    var $Model = '\App\Room';
    var $table = 'rooms';
    var $role = 'Admin';
    var $route_path = "admin.rooms";

    /** @test */
    public function user_can_index_model(){

        $this->seed_default_data();
        $user = $this->login_user($this->role);

        $instance = \App\Room::factory()->count(5)->create();

        $response = $this->get(route("$this->route_path.index"));
        $response->assertSessionHasNoErrors();
        $response->assertSuccessful();

    }

    /** @test */
    public function user_can_view_a_model(){

        $this->seed_default_data();
        $user = $this->login_user($this->role);

        $instance = \App\Room::factory()->create();

        $response = $this->get(route("$this->route_path.show", $instance));
        $response->assertSessionHasNoErrors();
        $response->assertSuccessful();

    }

    /** @test */
    public function user_can_store_a_model(){

        $this->seed_default_data();
        $user = $this->login_user($this->role);

        $instance = \App\Room::factory()->make();

        $initialCount = \App\Room::count();
        $response = $this->post(route("$this->route_path.store"), $instance->toArray());
        $this->assertDatabaseCount($this->table, $initialCount + 1);

        $response->assertSessionHasNoErrors();
    }

    /** @test */
    public function user_can_edit_a_model(){

        $this->seed_default_data();
        $user = $this->login_user($this->role);

        $instance = \App\Room::factory()->create();

        $response = $this->get(route("$this->route_path.edit", $instance));
        $response->assertSessionHasNoErrors();
        $response->assertSuccessful();

    }

    /** @test */
    public function user_can_update_a_model(){

        $this->seed_default_data();
        $user = $this->login_user($this->role);

        $instance = \App\Room::factory()->create();
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

        $instance = \App\Room::factory()->create();

        $response = $this->delete(route("$this->route_path.destroy", $instance));

        $this->assertModelSoftDeleted($instance);

        $response->assertSessionHasNoErrors();
    }
}