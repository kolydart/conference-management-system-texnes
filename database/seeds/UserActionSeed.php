<?php

use Illuminate\Database\Seeder;

class UserActionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'user_id' => 1, 'action' => 'deleted', 'action_model' => 'content_pages', 'action_id' => 1,],
            ['id' => 2, 'user_id' => 1, 'action' => 'created', 'action_model' => 'roles', 'action_id' => 6,],
            ['id' => 3, 'user_id' => 1, 'action' => 'updated', 'action_model' => 'roles', 'action_id' => 6,],
            ['id' => 4, 'user_id' => 1, 'action' => 'created', 'action_model' => 'roles', 'action_id' => 7,],

        ];

        foreach ($items as $item) {
            \App\UserAction::create($item);
        }
    }
}
