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
        
        $this->call(ArtSeed::class);
        $this->call(ContentPageSeed::class);
        $this->call(PermissionSeed::class);
        $this->call(RoleSeed::class);
        $this->call(UserSeed::class);
        $this->call(PaperSeed::class);
        $this->call(PaperSeedPivot::class);
        $this->call(RoleSeedPivot::class);
        $this->call(UserSeedPivot::class);
        $this->call(FirstStageFullDumpSeed::class);

    }
}
