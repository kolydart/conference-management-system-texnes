<?php

use App\ContentTag;
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
        factory(ContentTag::class,20)->create();
    }
}
