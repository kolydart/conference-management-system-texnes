<?php

use App\ContentCategory;
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
        factory(ContentCategory::class,10)->create();
    }
}
