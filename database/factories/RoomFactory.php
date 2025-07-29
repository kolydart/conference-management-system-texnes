<?php

namespace Database\Factories;

use App\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Room::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => 'Room ' . $this->faker->numberBetween(410, 950),
            'description' => $this->faker->sentence,
            'type' => $this->faker->randomElement(['Αμφιθέατρο', 'Αίθουσα διδασκαλίας', 'Αίθουσα τελετών', 'Εξωτερικός χώρος']),
            'wifi' => $this->faker->randomElement(['full', 'limited', 'none']),
            'capacity' => $this->faker->randomNumber(2),
        ];
    }
}