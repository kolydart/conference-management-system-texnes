<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1545910555FullpapersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fullpapers', function (Blueprint $table) {
            
if (!Schema::hasColumn('fullpapers', 'uuid')) {
                $table->string('uuid')->nullable();
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
        Schema::table('fullpapers', function (Blueprint $table) {
            $table->dropColumn('uuid');
            
        });

    }
}
