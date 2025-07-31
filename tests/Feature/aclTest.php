<?php

namespace Tests\Feature;

use App\Role;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class aclTest extends TestCase
{
    use DatabaseTransactions;


    /** @test */
    public function access_to_root_is_allowed(){
        $response = $this->get('/');
        $response->assertSuccessful();
    }

    /** @test */
    public function backend_requires_privileged_user(){

        $this->seed_default_data();

        // Test with manager role
        $this->login_user('Manager');
        $this->get('/admin/home')->assertStatus(200);
        $this->get('/admin/papers')->assertStatus(200);

        // Test with attendee role
        $this->login_user('Attendee');
        $this->get('/admin/home')->assertStatus(302);
        $this->get('/admin/papers')->assertStatus(302);
    }

}
