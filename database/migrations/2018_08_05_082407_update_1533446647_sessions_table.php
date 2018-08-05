<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1533446647SessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sessions', function (Blueprint $table) {
            if(Schema::hasColumn('sessions', 'end')) {
                $table->dropColumn('end');
            }
            
        });
Schema::table('sessions', function (Blueprint $table) {
            
if (!Schema::hasColumn('sessions', 'chair')) {
                $table->string('chair')->nullable();
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
            $table->dropColumn('chair');
            
        });
Schema::table('sessions', function (Blueprint $table) {
                        $table->datetime('end')->nullable();
                
        });

    }
}
