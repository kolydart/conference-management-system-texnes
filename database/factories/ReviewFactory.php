<?php

namespace Database\Factories;

use App\Review;
use App\Paper;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Review::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "user_id" => collect([1,2,3,4])->random(),
            "paper_id" => Paper::all()->random()->id,
            "review" => collect(["Approve","Neutral","Reject",])->random(),
            "comment" => $this->faker->paragraph,
        ];
    }
}
