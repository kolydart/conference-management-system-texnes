<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b30cbef2083bRelationshipsToJudgementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('judgements', function(Blueprint $table) {
            if (!Schema::hasColumn('judgements', 'paper_id')) {
                $table->integer('paper_id')->unsigned()->nullable();
                $table->foreign('paper_id', '4819_5b1a55fb3ea14')->references('id')->on('papers')->onDelete('cascade');
                }
                if (!Schema::hasColumn('judgements', 'created_by_id')) {
                $table->integer('created_by_id')->unsigned()->nullable();
                $table->foreign('created_by_id', '4819_5b1a5677ce99e')->references('id')->on('users')->onDelete('cascade');
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
        Schema::table('judgements', function(Blueprint $table) {
            
        });
    }
}
