<?php

use App\Room;
use Illuminate\Database\Seeder;

class RoomsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Room::class,6)->create();
    }
}
