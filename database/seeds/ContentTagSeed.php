<?php

use Illuminate\Database\Seeder;

class ContentTagSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'title' => 'Vitae architecto et dolor aute quo non duis aut ut', 'slug' => 'architecto',],
            ['id' => 2, 'title' => 'Tenetur nisi culpa in ut rerum id voluptas dolor Nam molestiae quia sint consequuntur voluptatem Rerum aut velit eum', 'slug' => 'culpa',],

        ];

        foreach ($items as $item) {
            \App\ContentTag::create($item);
        }
    }
}
