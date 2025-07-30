<?php

use App\Availability;
use Illuminate\Database\Seeder;

class AvailabilitySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Availability::factory()->count(10)->create();
    }
}
