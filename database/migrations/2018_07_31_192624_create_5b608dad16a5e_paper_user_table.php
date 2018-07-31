<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5b608dad16a5ePaperUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('paper_user')) {
            Schema::create('paper_user', function (Blueprint $table) {
                $table->integer('paper_id')->unsigned()->nullable();
                $table->foreign('paper_id', 'fk_p_190652_190520_user_p_5b608dad16b79')->references('id')->on('papers')->onDelete('cascade');
                $table->integer('user_id')->unsigned()->nullable();
                $table->foreign('user_id', 'fk_p_190520_190652_paper__5b608dad16c30')->references('id')->on('users')->onDelete('cascade');
                
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paper_user');
    }
}
