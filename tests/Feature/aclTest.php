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
        $response->assertStatus(200);
    }

    /** @test */
    public function backend_requires_privileged_user(){
        
        $this->signin_as_manager();
        $this->get('/admin/home')->assertStatus(200);
        $this->get('/admin/papers')->assertStatus(200);

        $this->signin_as_atendee();
        $this->get('/admin/home')->assertStatus(302)->getTargetUrl(route('frontend.home'));
        $this->get('/admin/papers')->assertStatus(302)->getTargetUrl(route('frontend.home'));
    }

}
