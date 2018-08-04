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
        factory(Session::class,30)->create();

        foreach (App\Paper::all() as $paper) {
        	$paper->update(['session_id'=> App\Session::all()->random()->id]);
        }
    }
}
