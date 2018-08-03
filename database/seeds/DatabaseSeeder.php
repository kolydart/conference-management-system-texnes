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
        
        $this->call(RoleSeed::class);
        $this->call(UserSeed::class);

        $this->call(ArtSeed::class);
        $this->call(PaperSeed::class);
        $this->call(DocumentSeed::class);
        $this->call(UserActionSeed::class);
        $this->call(ReviewSeed::class);
        $this->call(ContentCategorySeed::class);
        $this->call(ContentTagSeed::class);
        $this->call(ContentPageSeed::class);
        $this->call(MessageSeeder::class);
        $this->call(FullpaperSeeder::class);
    }
}
