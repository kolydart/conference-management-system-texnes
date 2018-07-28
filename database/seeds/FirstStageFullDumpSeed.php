<?php

use Illuminate\Database\Seeder;

class FirstStageFullDumpSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		Eloquent::unguard();
		$path = 'database/dumps/FirstStageFullDump.sql';
		DB::unprepared(file_get_contents($path));        
    }
}
