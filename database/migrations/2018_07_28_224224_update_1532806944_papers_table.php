<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1532806944PapersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('papers', function (Blueprint $table) {
            if(Schema::hasColumn('papers', 'informed')) {
                $table->dropColumn('informed');
            }
            
        });
Schema::table('papers', function (Blueprint $table) {
            
if (!Schema::hasColumn('papers', 'informed')) {
                $table->string('informed')->nullable();
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
            $table->dropColumn('informed');
            
        });
Schema::table('papers', function (Blueprint $table) {
                        $table->string('informed')->nullable();
                
        });

    }
}
