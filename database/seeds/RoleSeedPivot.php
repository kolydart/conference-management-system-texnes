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
                'permission' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 32, 33, 34, 35, 36, 37, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56],
            ],
            2 => [
                'permission' => [17, 18, 20, 12, 13, 14, 15, 16, 2, 7, 19, 22, 23, 24, 25, 26, 32, 33, 34, 35, 36, 37, 42, 43, 44, 45, 47, 48, 49, 50, 52, 53, 54, 55],
            ],
            3 => [
                'permission' => [2, 7, 12, 15, 22, 25, 32, 35],
            ],
            4 => [
                'permission' => [2, 7, 12, 15, 22, 25, 32, 33, 34, 35, 36],
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
