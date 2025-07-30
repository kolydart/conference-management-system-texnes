<?php

namespace Database\Factories;

use App\ContentPage;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContentPageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ContentPage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "title" => $this->faker->sentence,
            "alias" => $this->faker->word,
            "page_text" => $this->faker->paragraph,
            "excerpt" => $this->faker->paragraph,
        ];
    }
}
