<?php

use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class)->create(['email'=>'admin@admin.com', 'password'=>Hash::make('password'), 'role_id'=>5]);
        factory(\App\User::class,13)->create();
        factory(\App\User::class,5)->create(['role_id'=>5]);
        factory(\App\User::class,5)->create(['role_id'=>7]);
    }
}
