<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b5cf6c419479RelationshipsToPaperTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('papers', function(Blueprint $table) {
            if (!Schema::hasColumn('papers', 'reviews_id')) {
                $table->integer('reviews_id')->unsigned()->nullable();
                $table->foreign('reviews_id', '2801_5b5ccb7d1cbb0')->references('id')->on('judgements')->onDelete('cascade');
                }
                if (!Schema::hasColumn('papers', 'messages_id')) {
                $table->integer('messages_id')->unsigned()->nullable();
                $table->foreign('messages_id', '2801_5b5cf614acd16')->references('id')->on('messages')->onDelete('cascade');
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
        Schema::table('papers', function(Blueprint $table) {
            
        });
    }
}
