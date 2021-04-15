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
        $head = '<!DOCTYPE html> <html lang="el"> <head> <meta charset="utf-8"> <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous"> <style type="text/css">';
        $head.='
            body{
                font-family: Georgia, serif;
                line-height: 120%;
            }

            h1.Section{
                font-size: 24px;
                font-weight: bold;
                text-align: center;
            }

            h2.Title{
                font-size: 18px;
                font-weight: bold;
                text-align: center;
            }

            p.Author {
                font-size: 16px;
                font-weight: bold
                text-align: right;
            }

        ';
        $head.='</style></head> <body><div class="container">';
        fwrite($file, $head);

        /** Εργαστήριο: καλές πρακτικές */
        $collection = Paper::accepted()->lab()->where('description','<>','')->where('type','Εργαστήριο: καλές πρακτικές');

        fwrite($file, "<h1 class='Section'>Καλές Πρακτικές</h1>\n");
        foreach ($collection->get() as $item) {
            fwrite($file, $this->compile($item)."\n");
        }            

        /** Εργαστήριο: βιωματικές δράσεις */
        $collection = Paper::accepted()->lab()->where('description','<>','')->where('type','Εργαστήριο: βιωματικές δράσεις');

        fwrite($file, "<h1 class='Section'>Βιωματικές Δράσεις</h1>\n");
        foreach ($collection->get() as $item) {
            fwrite($file, $this->compile($item)."\n");
        }            

        /** close file */
        fwrite($file, '</div></body></html>');
        fclose($file);

        $this->info('Finished export');
    }

    public function compile($item){
        
            $buffer = "<article>\n";

            // 'title'
            $buffer.= "<h2 class='Title'>$item->title</h3>\n";

            // 'name'
            $buffer.= "<p class='Author'>$item->name</p>\n";

            // 'type'
            
            // 'duration'
            
            // 'email'
            // 'attribute'
            // 'phone'
            // 'abstract'
            // 'bio'
            // 'status'
            // 'informed'
            // 'order'
            // 'capacity'
            // 'objectives'
            // 'materials'
            // 'description'
            $buffer.= "<p class='Description'>$item->description</p>\n";
            // 'age'
            // 'evaluation'
            // 'video'
            // 'bibliography'
            // 'keywords'
            // 'lab_approved'
            // 'user_id'

            $buffer .= "</article>\n";

            return $buffer;
        
    }
    
}
