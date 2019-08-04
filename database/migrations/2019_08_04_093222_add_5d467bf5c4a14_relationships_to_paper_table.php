<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5d467bf5c4a14RelationshipsToPaperTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('papers', function(Blueprint $table) {
            if (!Schema::hasColumn('papers', 'user_id')) {
                $table->integer('user_id')->unsigned()->nullable();
                $table->foreign('user_id', '190652_5d467bef0ec9e')->references('id')->on('users')->onDelete('cascade');
                }
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
