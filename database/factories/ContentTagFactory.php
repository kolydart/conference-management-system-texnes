<?php

namespace Database\Factories;

use App\ContentTag;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContentTagFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ContentTag::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "title" => $this->faker->sentence,
            "slug" => $this->faker->word,
        ];
    }
}
