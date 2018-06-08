<?php

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
            
            ['id' => 1, 'title' => 'Veniam quasi quam sed adipisci molestiae assumenda labore qui animi iure dolore sapiente ea veniam ipsum dolores ipsum', 'page_text' => '<p>Sample text</p>
', 'excerpt' => 'Porro quos id sit aliquid ut', 'featured_image' => null,],

        ];

        foreach ($items as $item) {
            \App\ContentPage::create($item);
        }
    }
}
