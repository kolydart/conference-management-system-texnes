<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5bdaa6e91d5ebRelationshipsToMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('messages', function(Blueprint $table) {
            if (!Schema::hasColumn('messages', 'user_id')) {
                $table->integer('user_id')->unsigned()->nullable();
                $table->foreign('user_id', '191181_5bdaa6e7cb418')->references('id')->on('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('messages', 'page_id')) {
                $table->integer('page_id')->unsigned()->nullable();
                $table->foreign('page_id', '191181_5bdaa6e7db32f')->references('id')->on('content_pages')->onDelete('cascade');
                }
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
