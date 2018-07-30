<?php

use Illuminate\Database\Seeder;

class PaperSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 2, 'title' => 'Dolor voluptas ex sit cupiditate cupidatat iusto est irure iste minima', 'type' => 'Εισήγηση', 'duration' => '90', 'name' => 'Alexandra Ball', 'email' => 'howivigip@mailinator.net', 'attribute' => 'Ερευνητής', 'status' => 'Accepted', 'informed' => null, 'reviews_id' => null, 'messages_id' => null,],
            ['id' => 3, 'title' => 'Aut minim harum sed autem aut ut tempora nobis unde accusantium', 'type' => 'Εισήγηση', 'duration' => '90', 'name' => 'Lillian Fuentes', 'email' => 'zyweq@mailinator.com', 'attribute' => 'Εκπαιδευτικός Β/θμιας Εκπ/σης', 'status' => 'Rejected', 'informed' => null, 'reviews_id' => null, 'messages_id' => null,],

        ];

        foreach ($items as $item) {
            \App\Paper::create($item);
        }
    }
}
