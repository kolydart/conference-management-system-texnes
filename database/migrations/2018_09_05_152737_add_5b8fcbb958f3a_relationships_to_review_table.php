<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b8fcbb958f3aRelationshipsToReviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reviews', function(Blueprint $table) {
            if (!Schema::hasColumn('reviews', 'user_id')) {
                $table->integer('user_id')->unsigned()->nullable();
                $table->foreign('user_id', '190653_5b60916cf2e78')->references('id')->on('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('reviews', 'paper_id')) {
                $table->integer('paper_id')->unsigned()->nullable();
                $table->foreign('paper_id', '190653_5b608f9117168')->references('id')->on('papers')->onDelete('cascade');
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
        Schema::table('reviews', function(Blueprint $table) {
            
        });
    }
}
