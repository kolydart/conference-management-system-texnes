<?php

use App\Paper;
use App\User;
use Illuminate\Database\Seeder;

class UserAttendPaper extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (User::all() as $user) {
        	$user->attend()->attach(
				Paper::lab()->get()->random(
					collect([0,1,2,3])->random()
					)->pluck('id')->all()
        	);
        }
    }
}

