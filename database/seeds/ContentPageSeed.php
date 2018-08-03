<?php

use App\ContentCategory;
use App\ContentPage;
use App\ContentTag;
use Illuminate\Database\Seeder;

class ContentPageSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'title' => 'About us', 'page_text' => 'Sample text', 'excerpt' => 'Sample excerpt', 'featured_image' => '',],

        ];

        foreach ($items as $item) {
            \App\ContentPage::create($item);
        }

        factory(ContentPage::class,40)->create()->each(function($page){
            $page->category_id()->save(ContentCategory::all()->random());
            $page->tag_id()->saveMany(ContentTag::all()->random(3));
        });
    }
}
