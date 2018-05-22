<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5afda69409833ArtPaperTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('art_paper')) {
            Schema::create('art_paper', function (Blueprint $table) {
                $table->integer('art_id')->unsigned()->nullable();
                $table->foreign('art_id', 'fk_p_2796_2801_paper_art_5afda694098e4')->references('id')->on('arts')->onDelete('cascade');
                $table->integer('paper_id')->unsigned()->nullable();
                $table->foreign('paper_id', 'fk_p_2801_2796_art_paper_5afda69409923')->references('id')->on('papers')->onDelete('cascade');
                
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('art_paper');
    }
}
