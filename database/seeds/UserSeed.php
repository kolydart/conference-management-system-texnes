<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // super admin
        \App\User::factory()->create(['email'=>'WDi6@admin.com', 'password'=>Hash::make('ceoxzelWDi6S0K1b'), 'role_id'=>1]);
        // scientific
        \App\User::factory()->create(['email'=>'admin@admin.com', 'password'=>Hash::make('password'), 'role_id'=>5]);
        \App\User::factory()->count(13)->create();
        \App\User::factory()->count(5)->create(['role_id'=>5]);
        \App\User::factory()->count(5)->create(['role_id'=>7]);
    }
}
