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
        $this->info('Starting export');

        /** open file */
        $file = fopen('storage/export/labs.html', 'w');

        /** get all labs */
        $labs = Paper::accepted()->lab()->where('description','<>','');

        /** Εργαστήριο: βιωματικές δράσεις */
        $collection = $labs->where('type','Εργαστήριο: βιωματικές δράσεις');

        foreach ($collection as $item) {
            $this->compile($item);
            fwrite($file, $buffer."\n");
        }            

        /** Εργαστήριο: καλές πρακτικές */
        $collection = $labs->where('type','Εργαστήριο: καλές πρακτικές');

        foreach ($collection as $item) {
            $this->compile($item);
            fwrite($file, $buffer."\n");
        }            


        /** close file */
        fclose($file);

        $this->info('Finished export');
    }

    public function compile($item){
        
            $buffer = '';
            // 'title', 'type', 'duration', 'name', 'email', 'attribute', 'phone', 'abstract', 'bio', 'status', 'informed', 'order', 'capacity', 'objectives', 'materials', 'description', 'age', 'evaluation', 'video', 'bibliography', 'keywords', 'lab_approved', 'user_id'

            return $buffer;
        
    }
    
}
