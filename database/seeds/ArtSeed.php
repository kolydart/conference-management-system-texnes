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
            
            ['id' => 1, 'title' => 'Μουσική' ],
            ['id' => 2, 'title' => 'Θέατρο' ],
            ['id' => 3, 'title' => 'Χορός' ],
            ['id' => 4, 'title' => 'Κινηματογράφος' ],
            ['id' => 5, 'title' => 'Εικαστικά' ],
            ['id' => 6, 'title' => 'Μουσεία' ],
        ];

        foreach ($items as $item) {
            \App\Art::create($item);
        }
    }
}
