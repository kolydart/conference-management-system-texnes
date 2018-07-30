<?php

use Illuminate\Database\Seeder;

class RoleSeedPivot extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            1 => [
                'permission' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 32, 33, 34, 35, 36, 38, 39, 40, 41, 75, 76, 77, 78, 79, 80, 81, 82, 83, 84, 85, 86, 87, 88, 89, 90, 96, 97, 98, 99, 100, 22, 23, 24, 25, 26, 101],
            ],
            2 => [
                'permission' => [17, 18, 20, 12, 13, 14, 15, 16, 2, 7, 19, 32, 33, 35, 36, 38, 39, 40, 75, 76, 77, 78, 79, 81, 82, 83, 84, 86, 87, 88, 89, 96, 99, 22, 23, 24, 25],
            ],
            3 => [
                'permission' => [2, 7, 12, 15, 32, 35, 96, 99, 86, 89],
            ],
            4 => [
                'permission' => [2, 7, 12, 15, 32, 33, 35, 96, 99, 86, 89],
            ],

        ];

        foreach ($items as $id => $item) {
            $role = \App\Role::find($id);

            foreach ($item as $key => $ids) {
                $role->{$key}()->sync($ids);
            }
        }
    }
}
