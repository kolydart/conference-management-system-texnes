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
        factory(Message::class,30)->create();
    }
}
