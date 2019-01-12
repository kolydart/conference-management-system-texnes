<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePapersFieldsLength extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('papers', function(Blueprint $table) {
            $table->string('title', 2048)->change();
            $table->string('duration', 1024)->change();
            $table->string('age', 1024)->change();
            $table->string('keywords', 1024)->change();
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
            $table->string('title', 1024)->change();            
            $table->string('duration', 191)->change();            
            $table->string('age', 191)->change();            
            $table->string('keywords', 191)->change();            
        });
    }
}
