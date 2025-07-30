<?php

use App\Message;
use App\Paper;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Message::factory()->count(30)->create();
    }
}
