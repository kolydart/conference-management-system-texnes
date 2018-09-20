<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    function signin_as_manager(){
        $user = factory(User::class)->create(['role_id' => 3]);
        $this->actingAs($user);
        return $user;
    }

    function signin_as_atendee(){
        $user = factory(User::class)->create(['role_id' =>7]);
        $this->actingAs($user);
        return $user;
    }        
}
