<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1539073741LunchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lunches', function (Blueprint $table) {
            
if (!Schema::hasColumn('lunches', 'confirm')) {
                $table->tinyInteger('confirm')->nullable()->default('0');
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
        Schema::table('lunches', function (Blueprint $table) {
            $table->dropColumn('confirm');
            
        });

    }
}
