<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1532807934JudgementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('judgements', function (Blueprint $table) {
            if(Schema::hasColumn('judgements', 'user_id')) {
                $table->dropForeign('4819_5b30cfe2b5132');
                $table->dropIndex('4819_5b30cfe2b5132');
                $table->dropColumn('user_id');
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
        Schema::table('judgements', function (Blueprint $table) {
                        
        });

    }
}
