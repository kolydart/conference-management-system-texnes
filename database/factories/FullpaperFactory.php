<?php

namespace Database\Factories;

use App\Fullpaper;
use App\Paper;
use Illuminate\Database\Eloquent\Factories\Factory;

class FullpaperFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Fullpaper::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "paper_id" => Paper::all()->random(),
            "description" => $this->faker->sentence,
            "uuid" => $this->faker->uuid,
        ];
    }
}
