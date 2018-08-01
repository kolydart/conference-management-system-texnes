<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $this->call(ContentPageSeed::class);
        $this->call(RoleSeed::class);
        $this->call(UserSeed::class);

        $this->call(ArtSeed::class);
        $this->call(PaperSeed::class);
        $this->call(DocumentSeed::class);
        $this->call(UserActionSeed::class);
        $this->call(ReviewSeed::class);
    }
}
