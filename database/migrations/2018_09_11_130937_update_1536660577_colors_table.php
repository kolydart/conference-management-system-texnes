<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1536660577ColorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('colors', function (Blueprint $table) {
            
if (!Schema::hasColumn('colors', 'description')) {
                $table->string('description')->nullable();
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
        Schema::table('colors', function (Blueprint $table) {
            $table->dropColumn('description');
            
        });

    }
}
