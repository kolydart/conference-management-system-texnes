<?php

namespace App\Console\Commands;

use App\Paper;
use Illuminate\Console\Command;

class exportLabsToFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'export:labs2file';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export lab contents for print';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // $this->info('Starting export');

        /** main command */
        $labs = Paper::accepted()->lab()->where('description','<>','')->get();

        /** prepare file */
        $file = fopen('storage/export/labs.html', 'w');
        foreach ($labs as $lab) {
          fwrite($file, $lab->id."\n");
        }
        fclose($file);

        $this->info('Finished export');
    }
}
