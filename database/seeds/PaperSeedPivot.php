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
                'art' => [5],
                'assign' => [],
            ],
            3 => [
                'art' => [5],
                'assign' => [],
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
