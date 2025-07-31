<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Role;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;

class DebugTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function debug_role_creation()
    {
        $this->seed_default_data();
        
        // Check what roles were created
        $roles = Role::all();
        dump("Total roles: " . $roles->count());
        foreach ($roles as $role) {
            dump("Role ID: {$role->id}, Title: {$role->title}");
        }
        
        // Try to create an Admin user
        $user = $this->login_user('Admin');
        dump("User role_id: {$user->role_id}");
        dump("User approved: {$user->approved}");
        
        // Check if user has backend access
        dump("Has backend_access: " . (\Gate::allows('backend_access') ? 'YES' : 'NO'));
        dump("Has user_access: " . (\Gate::allows('user_access') ? 'YES' : 'NO'));
        
        $this->assertTrue(true);
    }
}