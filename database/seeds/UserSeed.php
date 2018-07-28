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
            
            ['id' => 4, 'name' => 'Test admin, please remove', 'email' => 'n-vue.quickadminpanel.com@gateweb.gr', 'password' => '$2y$10$zn/T/UpEcC3l7jG6RMk/pOL8fL22CIAKdh7gw8Of6QJFzYLGUwKoW', 'remember_token' => null,],

        ];

        foreach ($items as $item) {
            \App\User::create($item);
        }
    }
}
