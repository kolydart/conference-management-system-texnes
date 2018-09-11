<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1536663191ColorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('colors', function (Blueprint $table) {
            if(Schema::hasColumn('colors', 'description')) {
                $table->dropColumn('description');
            }
            
        });
Schema::table('colors', function (Blueprint $table) {
            
if (!Schema::hasColumn('colors', 'value')) {
                $table->string('value')->nullable();
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
            $table->dropColumn('value');
            
        });
Schema::table('colors', function (Blueprint $table) {
                        $table->string('description')->nullable();
                
        });

    }
}
