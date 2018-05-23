<?php

use Illuminate\Database\Seeder;

class PaperSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'title' => null, 'type' => 'Εισήγηση', 'duration' => '45', 'name' => null, 'email' => null, 'attribute' => null, 'status' => null,],

        ];

        foreach ($items as $item) {
            \App\Paper::create($item);
        }
    }
}
