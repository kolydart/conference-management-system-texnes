<?php

namespace Database\Factories;

use App\Paper;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaperFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Paper::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $types = ["Εισήγηση", "Εργαστήριο: βιωματικές δράσεις", "Εργαστήριο: καλές πρακτικές"];
        $durations = ["20", "45", "90"];
        $i = collect([0, 1, 2])->random();
        
        return [
            'title' => $this->faker->sentence,
            'type' => $types[$i],
            'duration' => $durations[$i],
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'attribute' => $this->faker->randomElement([
                "Μέλος ΔΕΠ",
                "Μέλος ΕΕΠ",
                "Μέλος ΕΔΙΠ",
                "Διδάκτωρ / Ερευνητής",
                "Υποψήφιος Διδάκτωρ",
                "Μεταπτυχιακός/ή Φοιτητής/τρια",
                "Προπτυχιακός/ή Φοιτητής/τρια",
                "Στέλεχος Εκπαίδευσης",
                "Εκπαιδευτικός Πρωτοβάθμιας Εκπαίδευσης",
                "Εκπαιδευτικός Δευτεροβάθμιας Εκπαίδευσης",
                "Καλλιτέχνης"
            ]),
            'phone' => $this->faker->phoneNumber,
            'abstract' => $this->faker->paragraph,
            'bio' => $this->faker->paragraph,
            'status' => $this->faker->randomElement(['Accepted', 'Rejected', 'Pending']),
            'informed' => $this->faker->randomElement(['Unaware', 'Informed']),
            'order' => $this->faker->randomNumber(2),
            'capacity' => $this->faker->randomNumber(2),
            // Optional relationships - can be overridden in tests
            'user_id' => null,
            'session_id' => null,
        ];
    }
}