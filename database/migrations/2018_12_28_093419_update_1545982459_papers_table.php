<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1545982459PapersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('papers', function (Blueprint $table) {
            
if (!Schema::hasColumn('papers', 'age')) {
                $table->string('age')->nullable();
                }
if (!Schema::hasColumn('papers', 'keywords')) {
                $table->string('keywords')->nullable();
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
            $table->dropColumn('age');
            $table->dropColumn('keywords');
            
        });

    }
}
