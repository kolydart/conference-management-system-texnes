<?php

namespace Database\Factories;

use App\ContentCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContentCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ContentCategory::class;

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
