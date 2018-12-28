<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c261f0815cfaRelationshipsToPaperTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('papers', function(Blueprint $table) {
            if (!Schema::hasColumn('papers', 'session_id')) {
                $table->integer('session_id')->unsigned()->nullable();
                $table->foreign('session_id', '190652_5b657bbc7a22c')->references('id')->on('sessions')->onDelete('cascade');
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
