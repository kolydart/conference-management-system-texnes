<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b6fdb8fcee7fRelationshipsToLoguseragentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('loguseragents', function(Blueprint $table) {
            if (!Schema::hasColumn('loguseragents', 'user_id')) {
                $table->integer('user_id')->unsigned()->nullable();
                $table->foreign('user_id', '195169_5b6fdb8f3ed7b')->references('id')->on('users')->onDelete('cascade');
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
        Schema::table('loguseragents', function(Blueprint $table) {
            
        });
    }
}
