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
        ContentCategory::factory()->count(10)->create();
    }
}
