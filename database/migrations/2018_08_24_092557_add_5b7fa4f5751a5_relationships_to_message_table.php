<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b7fa4f5751a5RelationshipsToMessageTable extends Migration
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
                $table->foreign('paper_id', '191181_5b61c06d2fd32')->references('id')->on('papers')->onDelete('cascade');
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
