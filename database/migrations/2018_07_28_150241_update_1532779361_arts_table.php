<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1532779361ArtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('arts', function (Blueprint $table) {
            
if (!Schema::hasColumn('arts', 'name')) {
                $table->string('name')->nullable();
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
        Schema::table('arts', function (Blueprint $table) {
            $table->dropColumn('name');
            
        });

    }
}
