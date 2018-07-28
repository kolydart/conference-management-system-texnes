<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1532819224PapersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('papers', function (Blueprint $table) {
            if(Schema::hasColumn('papers', 'messages_id')) {
                $table->dropForeign('2801_5b5cf614acd16');
                $table->dropIndex('2801_5b5cf614acd16');
                $table->dropColumn('messages_id');
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
        Schema::table('papers', function (Blueprint $table) {
                        
        });

    }
}
