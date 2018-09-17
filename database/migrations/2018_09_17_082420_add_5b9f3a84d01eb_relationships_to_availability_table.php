<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b9f3a84d01ebRelationshipsToAvailabilityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('availabilities', function(Blueprint $table) {
            if (!Schema::hasColumn('availabilities', 'color_id')) {
                $table->integer('color_id')->unsigned()->nullable();
                $table->foreign('color_id', '205283_5b9f3a841d858')->references('id')->on('colors')->onDelete('cascade');
                }
                if (!Schema::hasColumn('availabilities', 'room_id')) {
                $table->integer('room_id')->unsigned()->nullable();
                $table->foreign('room_id', '205283_5b923738025fc')->references('id')->on('rooms')->onDelete('cascade');
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
        Schema::table('availabilities', function(Blueprint $table) {
            
        });
    }
}
