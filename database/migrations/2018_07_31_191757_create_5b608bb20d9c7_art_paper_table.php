<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5b608bb20d9c7ArtPaperTable extends Migration
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
                $table->foreign('art_id', 'fk_p_190654_190652_paper__5b608bb20daf6')->references('id')->on('arts')->onDelete('cascade');
                $table->integer('paper_id')->unsigned()->nullable();
                $table->foreign('paper_id', 'fk_p_190652_190654_art_pa_5b608bb20db86')->references('id')->on('papers')->onDelete('cascade');
                
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
