<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1536336876AvailabilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('availabilities', function (Blueprint $table) {
            if(Schema::hasColumn('availabilities', 'room_id')) {
                $table->dropForeign('205283_5b923738025fc');
                $table->dropIndex('205283_5b923738025fc');
                $table->dropColumn('room_id');
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
        Schema::table('availabilities', function (Blueprint $table) {
                        
        });

    }
}
