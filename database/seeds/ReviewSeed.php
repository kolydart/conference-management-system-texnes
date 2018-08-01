<?php

use App\Review;
use App\Paper;
use App\User;
use Illuminate\Database\Seeder;

class ReviewSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach (User::all()->pluck('id') as $user_id) {
            $papers = Paper::whereHas('assign', function ($query) use ($user_id) {
                $query->where('id', $user_id);
                })->get();
            foreach ($papers as $paper) {
                if(rand(0, 1))
                    factory(Review::class)->create(['paper_id'=>$paper->id, 'user_id'=>$user_id]);
            }
        }
    }
}
