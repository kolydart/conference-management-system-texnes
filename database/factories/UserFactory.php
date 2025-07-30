<?php

namespace Database\Factories;

use App\User;
use App\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $email = $this->faker->safeEmail;
        $password = substr($email, 0, strpos($email, '@'));
        
        return [
            'name' => $this->faker->name,
            'email' => $email,
            'checkin' => $this->faker->randomElement(['Checked-in', 'Αbsent']),
            'password' => $password,
            'role_id' => function() {
                // Try to find an existing role, create one if none exist
                $role = Role::first();
                if (!$role) {
                    $role = Role::create(['id' => 1, 'title' => 'Test Role']);
                }
                return $role->id;
            },
            'remember_token' => $password,
            'phone' => $this->faker->phoneNumber,
            'attribute' => $this->faker->randomElement([
                'Εκπαιδευτικός ΠΕ 91.01',
                'Εκπαιδευτικός ΠΕ 79.01',
                'Εκπαιδευτικός ΠΕ 08',
                'Εκπαιδευτικός ΠΕ 70',
                'Εκπαιδευτικός ΠΕ 60',
                'Εκπαιδευτικός ΠΕ 02',
                'Εκπαιδευτικός ΠΕ 11',
                'Εκπαιδευτικός ΠΕ 05 / 06 / 07 / 34 / 40',
                'Εκπαιδευτικός ΠΕ 03/ 04',
                'Εκπαιδευτικός ΠΕ 01',
                'Εκπαιδευτικός ΠΕ 86',
                'Εκπαιδευτικός ΠΕ 36',
                'Προπτυχιακός/ή Φοιτητής /τρια',
                'Μεταπτυχιακός /η Φοιτητής / τρια',
                'Διδάκτορας',
                'Ανεξάρτητος Ερευνητής',
                'Μέλος ΕΔΙΠ / ΕΕΠ',
                'Μέλος ΔΕΠ',
                'Ομότιμος Καθηγητής / τρια',
                'Άλλο'
            ]),
            'approved' => 1,
        ];
    }
}