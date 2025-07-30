<?php

use App\Session;
use Illuminate\Database\Seeder;

class SessionsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Session::factory()->count(30)->create();

        foreach (App\Paper::all() as $paper) {
        	$paper->update(['session_id'=> App\Session::all()->random()->id]);
        }
    }
}
