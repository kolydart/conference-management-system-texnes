<?php

use Illuminate\Database\Seeder;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['id' => 1, 'title' => 'Admin'],
            ['id' => 3, 'title' => 'Manager'],
            ['id' => 4, 'title' => 'Organizing Committee'],
            ['id' => 5, 'title' => 'Scientific Committee'],
            ['id' => 6, 'title' => 'Author'],
            ['id' => 7, 'title' => 'Attendee'],
            ['id' => 8, 'title' => 'Secretary'],
            ['id' => 9, 'title' => 'Volunteer'],
            ['id' => 10, 'title' => 'Proceedings Editors'],
        ];

        \App\Role::upsert($items, ['id'], ['title']);
    }
}
