<?php

namespace Tests\Feature;

use App\Paper;
use Tests\TestCase;

class PapersTest extends TestCase
{

    /**
     * @var string plural lowercase kebab-case
     * @example (users|papers); admin.(users|papers).index for User|Paper model
     */
    static $route_particle = 'papers';

    /**
     * @var string plural lowercase snake_case
     * usually equal to self::$route_particle
     * differs on multi-word models
     */
    static $view_particle = 'papers';

    var $Model = '\App\Paper';
    var $table = 'papers';
    var $role = 'Admin';
    var $route_path = "admin.papers";

    /** @test */
    public function user_can_index_model(){
        $user = $this->login_user($this->role);

        // Create dependencies first - Session factory needs Room and Color
        $rooms = \App\Room::factory(2)->create();
        $colors = \App\Color::factory(2)->create();
        $session = \App\Session::factory()->create([
            'room_id' => $rooms->first()->id,
            'color_id' => $colors->first()->id,
        ]);

        // Create papers with proper relationships
        $instance = $this->Model::factory(5)->create([
            'user_id' => $user->id, // Associate with the logged-in user
            'session_id' => $session->id, // Associate with a session
        ]);

        $response = $this->get(route("$this->route_path.index"));
        $response->assertSessionHasNoErrors();
        $response->assertSuccessful();

    }

    /** @test */
    public function user_can_view_a_model(){
        $user = $this->login_user($this->role);

        // Create dependencies first - Session factory needs Room and Color
        $rooms = \App\Room::factory(2)->create();
        $colors = \App\Color::factory(2)->create();
        $session = \App\Session::factory()->create([
            'room_id' => $rooms->first()->id,
            'color_id' => $colors->first()->id,
        ]);

        $instance = $this->Model::factory()->create([
            'user_id' => $user->id,
            'session_id' => $session->id,
        ]);

                $response = $this->get(route("$this->route_path.show", $instance));
        $response->assertSessionHasNoErrors();
        $response->assertSuccessful();

    }

    /** @test */
    public function user_can_store_a_model(){
        $user = $this->login_user($this->role);

        // Create dependencies
        $rooms = \App\Room::factory(2)->create();
        $colors = \App\Color::factory(2)->create();
        $session = \App\Session::factory()->create([
            'room_id' => $rooms->first()->id,
            'color_id' => $colors->first()->id,
        ]);

        // Create required art records
        $arts = \App\Art::factory(2)->create();

        $instance = $this->Model::factory()->make([
            'user_id' => $user->id,
            'session_id' => $session->id,
        ]);

        $data = $instance->toArray();
        $data['art'] = [$arts->first()->id]; // Add required art relationship

                $this->assertDatabaseCount($this->table, 0);
        $response = $this->post(route("$this->route_path.store"), $data);
        $this->assertDatabaseCount($this->table, 1);

        $response->assertSessionHasNoErrors();
    }

    /** @test */
    public function user_can_edit_a_model(){
        $user = $this->login_user($this->role);

        // Create dependencies
        $rooms = \App\Room::factory(2)->create();
        $colors = \App\Color::factory(2)->create();
        $session = \App\Session::factory()->create([
            'room_id' => $rooms->first()->id,
            'color_id' => $colors->first()->id,
        ]);

        $instance = $this->Model::factory()->create([
            'user_id' => $user->id,
            'session_id' => $session->id,
        ]);

        $response = $this->get(route("$this->route_path.edit", $instance));
        $response->assertSessionHasNoErrors();
        $response->assertSuccessful();

    }

    /** @test */
    public function user_can_update_a_model(){
        $user = $this->login_user($this->role);

        // Create dependencies
        $rooms = \App\Room::factory(2)->create();
        $colors = \App\Color::factory(2)->create();
        $session = \App\Session::factory()->create([
            'room_id' => $rooms->first()->id,
            'color_id' => $colors->first()->id,
        ]);

        // Create required art records
        $arts = \App\Art::factory(2)->create();

        $instance = $this->Model::factory()->create([
            'user_id' => $user->id,
            'session_id' => $session->id,
        ]);

        $data = $instance->toArray();
        $data['art'] = [$arts->first()->id]; // Add required art relationship

        $response = $this->put(route("$this->route_path.update", $instance), $data);

        $freshInstance = $instance->fresh();

        $instanceAttrs = array_filter($instance->getAttributes());
        $freshAttrs = array_filter($freshInstance->getAttributes());

        unset($instanceAttrs['updated_at'], $freshAttrs['updated_at']);

        $this->assertEquals($instanceAttrs, $freshAttrs);
        $this->assertDatabaseCount($this->table, 1);
        $response->assertSessionHasNoErrors();
    }

    /** @test */
    public function user_can_delete_a_model(){
        $user = $this->login_user($this->role);

        // Create dependencies
        $rooms = \App\Room::factory(2)->create();
        $colors = \App\Color::factory(2)->create();
        $session = \App\Session::factory()->create([
            'room_id' => $rooms->first()->id,
            'color_id' => $colors->first()->id,
        ]);

        $instance = $this->Model::factory()->create([
            'user_id' => $user->id,
            'session_id' => $session->id,
        ]);

        $response = $this->delete(route("$this->route_path.destroy", $instance));

        $this->assertSoftDeleted($instance);

        $response->assertSessionHasNoErrors();
    }
}