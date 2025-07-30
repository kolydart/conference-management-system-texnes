<?php

namespace Database\Factories;

use App\Message;
use App\Paper;
use App\User;
use App\ContentPage;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Message::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "paper_id" => Paper::all()->random(),
            "name" => $this->faker->name,
            "title" => $this->faker->sentence,
            "email" => $this->faker->safeEmail,
            "body" => $this->faker->paragraph,
            "user_id" => User::all()->random(),
            "page_id" => ContentPage::all()->random(),
        ];
    }
}
