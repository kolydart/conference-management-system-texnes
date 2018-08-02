<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b62dedf250f1RelationshipsToFullpaperTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fullpapers', function(Blueprint $table) {
            if (!Schema::hasColumn('fullpapers', 'paper_id')) {
                $table->integer('paper_id')->unsigned()->nullable();
                $table->foreign('paper_id', '191541_5b62dedebf96d')->references('id')->on('papers')->onDelete('cascade');
                }
                
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fullpapers', function(Blueprint $table) {
            
        });
    }
}
