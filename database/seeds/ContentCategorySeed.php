<?php

use Illuminate\Database\Seeder;

class ContentCategorySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'title' => 'Id officia molestiae voluptates vel et in rerum quia quia', 'slug' => 'officia',],
            ['id' => 2, 'title' => 'In voluptate quis aspernatur magnam pariatur Nulla et fugiat dolore dolores quis tempora fuga Id officia', 'slug' => 'voluptate',],

        ];

        foreach ($items as $item) {
            \App\ContentCategory::create($item);
        }
    }
}
