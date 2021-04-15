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

        /** trick to create paragraph styles in word */
        $head.='
            h1.section{color:black;}
            h2.title{color:black;}
            h3.author{color:black;}
            h3.keywords{color:black;}
            div.keywords{color:black;}
            h3.age{color:black;}
            div.age{color:black;}
            h3.objectives{color:black;}
            div.objectives{color:black;}
            h3.materials{color:black;}
            div.materials{color:black;}
            h3.description{color:black;}
            div.description{color:black;}
            h3.evaluation{color:black;}
            div.evaluation{color:black;}
            h3.video{color:black;}
            div.video{color:black;}
            h3.bibliography{color:black;}
            div.bibliography{color:black;}
            h3.bio{color:black;}
            div.bio{color:black;}            
        ';

        $head.='</style></head> <body><div class="container">';
        fwrite($file, $head);

        /** Εργαστήριο: καλές πρακτικές */
        $collection = Paper::accepted()->lab()->where('description','<>','')->where('type','Εργαστήριο: καλές πρακτικές')->orderBy('order');

        fwrite($file, "<h1 class='section'>Καλές Πρακτικές</h1>\n");
        foreach ($collection->get() as $item) {
            fwrite($file, $this->compile($item)."\n");
        }            

        /** Εργαστήριο: βιωματικές δράσεις */
        $collection = Paper::accepted()->lab()->where('description','<>','')->where('type','Εργαστήριο: βιωματικές δράσεις')->orderBy('order');

        fwrite($file, "<h1 class='section'>Βιωματικές Δράσεις</h1>\n");
        foreach ($collection->get() as $item) {
            fwrite($file, $this->compile($item)."\n");
        }

        /** abstracts, bio */
        /**
         * @todo
         */
        fwrite($file, "<h1 class='section'>Βιωματικές Δράσεις</h1>\n");
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
            $buffer.= "<h2 class='title'>$item->title</h3>\n";

            // 'name'
            $buffer.= "<h3 class='author'>$item->name</h3>\n";

            // 'type'
            // 'duration'
            // 'email'
            // 'attribute'
            // 'phone'
            // 'status'
            // 'informed'
            // 'order'
            // 'capacity'
            
            // 'abstract'
            if($item->abstract){
                $buffer.= "<h3 class='abstract'>".__('quickadmin.papers.fields.abstract')."</h3>\n";
                $buffer.= "<div class='abstract'>".$item->abstract."</div>\n";
            }

            // 'keywords'
            if($item->keywords){
                $buffer.= "<h3 class='keywords'>".__('quickadmin.papers.fields.keywords')."</h3>\n";
                $buffer.= "<div class='keywords'>".$item->keywords."</div>\n";
            }

            // 'age'
            if($item->age){
                $buffer.= "<h3 class='age'>".__('quickadmin.papers.fields.age')."</h3>\n";
                $buffer.= "<div class='age'>".$item->age."</div>\n";
            }

            // 'objectives'
            if($item->objectives){
                $buffer.= "<h3 class='objectives'>".__('quickadmin.papers.fields.objectives')."</h3>\n";
                $buffer.= "<div class='objectives'>".$item->objectives."</div>\n";
            }
            
            // 'materials'
            if($item->materials){
                $buffer.= "<h3 class='materials'>".__('quickadmin.papers.fields.materials')."</h3>\n";
                $buffer.= "<div class='materials'>".$item->materials."</div>\n";
            }
            
            // 'description'
            if($item->description){
                $buffer.= "<h3 class='description'>".__('quickadmin.papers.fields.description')."</h3>\n";
                $buffer.= "<div class='description'>".$item->description."</div>\n";
            }


            // 'evaluation'
            if($item->evaluation){
                $buffer.= "<h3 class='evaluation'>".__('quickadmin.papers.fields.evaluation')."</h3>\n";
                $buffer.= "<div class='evaluation'>".$item->evaluation."</div>\n";
            }

            // 'video'
            if($item->video){
                $buffer.= "<h3 class='video'>".__('quickadmin.papers.fields.video')."</h3>\n";
                $buffer.= "<div class='video'>".$item->video."</div>\n";
            }

            // 'bibliography'
            if($item->bibliography){
                $buffer.= "<h3 class='bibliography'>".__('quickadmin.papers.fields.bibliography')."</h3>\n";
                $buffer.= "<div class='bibliography'>".$item->bibliography."</div>\n";
            }

            // 'bio'
            if($item->bio){
                $buffer.= "<h3 class='bio'>".__('quickadmin.papers.fields.bio')."</h3>\n";
                $buffer.= "<div class='bio'>".$item->bio."</div>\n";
            }

            // 'lab_approved'
            // 'user_id'


            $buffer .= "</article>\n";

            return $buffer;
        
    }
    
}
