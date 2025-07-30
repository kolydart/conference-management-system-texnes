<?php

namespace Database\Factories;

use App\Availability;
use App\Room;
use App\Color;
use Illuminate\Database\Eloquent\Factories\Factory;

class AvailabilityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Availability::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $date = $this->faker->dateTimeBetween($startDate = '2018-10-11', $endDate = '2018-10-14');
        $obj = \Carbon\Carbon::instance($date)->setTime($this->faker->numberBetween(10,18), 0, 0);

        return [
            "room_id" => collect([Room::all()->random()->id, null])->random(),
            "color_id" => Color::factory()->create(),
            "start" => $obj->format('Y-m-d H:i:s'),
            "end" => $obj->copy()->addHours(collect([1,2,3])->random())->format('Y-m-d H:i:s'),
            "notes" => $this->faker->sentence,
        ];
    }
}
