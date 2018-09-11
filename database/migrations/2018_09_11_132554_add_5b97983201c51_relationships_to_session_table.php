<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b97983201c51RelationshipsToSessionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sessions', function(Blueprint $table) {
            if (!Schema::hasColumn('sessions', 'room_id')) {
                $table->integer('room_id')->unsigned()->nullable();
                $table->foreign('room_id', '192311_5b657af100f2c')->references('id')->on('rooms')->onDelete('cascade');
                }
                if (!Schema::hasColumn('sessions', 'color_id')) {
                $table->integer('color_id')->unsigned()->nullable();
                $table->foreign('color_id', '192311_5b979039bb949')->references('id')->on('colors')->onDelete('cascade');
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
        Schema::table('sessions', function(Blueprint $table) {
            
        });
    }
}
