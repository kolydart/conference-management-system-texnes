<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b5cf5a2d2c49RelationshipsToMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('messages', function(Blueprint $table) {
            if (!Schema::hasColumn('messages', 'paper_id')) {
                $table->integer('paper_id')->unsigned()->nullable();
                $table->foreign('paper_id', '9410_5b5cf5a2a8a2a')->references('id')->on('papers')->onDelete('cascade');
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
        Schema::table('messages', function(Blueprint $table) {
            
        });
    }
}
