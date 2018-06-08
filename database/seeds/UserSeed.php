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
            
            ['id' => 1, 'name' => 'Τάσος Κολυδάς', 'email' => 'sci-texnes-ellinikosxoleio@kolydart.gr', 'password' => '$2y$10$bC0.tC2oJlMpK2PuJNdJu.hriUmJmRjGBFqLY/uYQhC69AFPrYye.', 'remember_token' => '',],
            ['id' => 2, 'name' => 'Μηνάς Αλεξιάδης', 'email' => 'minalexi@ath.forthnet.gr', 'password' => 'minalexi', 'remember_token' => null,],
            ['id' => 3, 'name' => 'Ίλια Λακίδου', 'email' => 'ilakidou@theatre.uoa.gr', 'password' => 'ilakidou', 'remember_token' => null,],

        ];

        foreach ($items as $item) {
            \App\User::create($item);
        }
    }
}
