<?php

use App\Art;
use App\Paper;
use App\User;
use Illuminate\Database\Seeder;

class PaperSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = (App::environment()=='testing')?5:200;

        /**
         * create papers & relate with arts & users
         */
        factory(Paper::class,$count)->create()->each(function ($paper) {
            $arts = Art::all()->random(3); // pick three random
            $paper->art()->save($arts->splice(0, 1)->first()); // always get first
            foreach ($arts as $art) { // the rest: random
                if(collect([0,1])->random()){
                    $paper->art()->save($art);
                }
            }
            $users = User::where('role_id',5)->get()->random(2);
            foreach ($users as $user) {
                if(collect([0,1])->random()){
                    $paper->assign()->save($user);

                }
            }
        });

    }
}
