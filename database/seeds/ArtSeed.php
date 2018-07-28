<?php

use Illuminate\Database\Seeder;

class ArtSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 5, 'name' => 'Μουσική',],

        ];

        foreach ($items as $item) {
            \App\Art::create($item);
        }
    }
}
