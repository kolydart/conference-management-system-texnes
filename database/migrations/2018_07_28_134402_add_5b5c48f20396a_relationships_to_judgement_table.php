<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b5c48f20396aRelationshipsToJudgementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('judgements', function(Blueprint $table) {
            if (!Schema::hasColumn('judgements', 'user_id')) {
                $table->integer('user_id')->unsigned()->nullable();
                $table->foreign('user_id', '4819_5b30cfe2b5132')->references('id')->on('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('judgements', 'paper_id')) {
                $table->integer('paper_id')->unsigned()->nullable();
                $table->foreign('paper_id', '4819_5b1a55fb3ea14')->references('id')->on('papers')->onDelete('cascade');
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
