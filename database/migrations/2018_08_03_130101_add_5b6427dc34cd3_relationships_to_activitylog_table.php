<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b6427dc34cd3RelationshipsToActivitylogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activitylogs', function(Blueprint $table) {
            if (!Schema::hasColumn('activitylogs', 'causer_id')) {
                $table->integer('causer_id')->unsigned()->nullable();
                $table->foreign('causer_id', '192001_5b6427dbb5a95')->references('id')->on('users')->onDelete('cascade');
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
        Schema::table('activitylogs', function(Blueprint $table) {
            
        });
    }
}
