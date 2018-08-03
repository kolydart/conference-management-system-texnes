<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1533291617ActivitylogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activitylogs', function (Blueprint $table) {
            if(Schema::hasColumn('activitylogs', 'causer_id')) {
                $table->dropForeign('192001_5b6427dbb5a95');
                $table->dropIndex('192001_5b6427dbb5a95');
                $table->dropColumn('causer_id');
            }
            
        });
Schema::table('activitylogs', function (Blueprint $table) {
            
if (!Schema::hasColumn('activitylogs', 'causer_id')) {
                $table->integer('causer_id')->nullable();
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
        Schema::table('activitylogs', function (Blueprint $table) {
            $table->dropColumn('causer_id');
            
        });
Schema::table('activitylogs', function (Blueprint $table) {
                        
        });

    }
}
