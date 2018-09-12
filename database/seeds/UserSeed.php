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
        $items = [
            
            ['id' => 1, 'name' => 'admin', 'email' => 'n-vue.quickadminpanel.com@gateweb.gr', 'password' => '$2y$10$eJGoqrdu7M0x9nYMhDhBxOeW25eMBoMtsgM7hT4VfSQl44Ht37pdm', 'role_id' => 1, 'remember_token' => '',],

        ];

        foreach ($items as $item) {
            \App\User::create($item);
        }

        factory(\App\User::class,13)->create();
        factory(\App\User::class,5)->create(['role_id'=>5]);
    }
}
