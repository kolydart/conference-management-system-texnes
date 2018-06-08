<?php

use Illuminate\Database\Seeder;

class PaperSeedPivot extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            2 => [
                'art' => [1, 2],
                'assign' => [2, 3],
            ],
            3 => [
                'art' => [2, 3],
                'assign' => [3],
            ],
            4 => [
                'art' => [2, 3],
                'assign' => [2],
            ],

        ];

        foreach ($items as $id => $item) {
            $paper = \App\Paper::find($id);

            foreach ($item as $key => $ids) {
                $paper->{$key}()->sync($ids);
            }
        }
    }
}
