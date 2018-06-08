<?php

use Illuminate\Database\Seeder;

class JudgementSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'paper_id' => 3, 'judgement' => 'Reject', 'comment' => 'Porro magnam et porro non', 'created_by_id' => 1,],
            ['id' => 2, 'paper_id' => 2, 'judgement' => 'Approve', 'comment' => null, 'created_by_id' => 1,],

        ];

        foreach ($items as $item) {
            \App\Judgement::create($item);
        }
    }
}
