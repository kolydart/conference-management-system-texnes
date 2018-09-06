<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1536231677SessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sessions', function (Blueprint $table) {
            if(Schema::hasColumn('sessions', 'room_id')) {
                $table->dropForeign('192311_5b657af100f2c');
                $table->dropIndex('192311_5b657af100f2c');
                $table->dropColumn('room_id');
            }
            if(Schema::hasColumn('sessions', 'start')) {
                $table->dropColumn('start');
            }
            
        });
Schema::table('sessions', function (Blueprint $table) {
            
if (!Schema::hasColumn('sessions', 'start')) {
                $table->datetime('start')->nullable();
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
        Schema::table('sessions', function (Blueprint $table) {
            $table->dropColumn('start');
            
        });
Schema::table('sessions', function (Blueprint $table) {
                        $table->datetime('start')->nullable();
                
        });

    }
}
