<?php

namespace Database\Factories;

use App\Session;
use App\Color;
use App\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

class SessionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Session::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $date = $this->faker->dateTimeBetween($startDate = '2018-10-11', $endDate = '2018-10-14');
        $obj = \Carbon\Carbon::instance($date)->setTime($this->faker->numberBetween(10, 18), 0, 0);

        return [
            'title' => $this->faker->sentence,
            'room_id' => Room::all()->random()->id,
            'start' => $obj->format('Y-m-d H:i:s'),
            'duration' => '0' . $this->faker->numberBetween(1, 3) . ':00:00',
            'chair' => $this->faker->name,
            'color_id' => Color::all()->random()->id,
        ];
    }
}