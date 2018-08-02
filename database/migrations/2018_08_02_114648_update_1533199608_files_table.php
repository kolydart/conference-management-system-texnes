<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1533199608FilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('files', function (Blueprint $table) {
            
if (!Schema::hasColumn('files', 'description')) {
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
        Schema::table('files', function (Blueprint $table) {
            $table->dropColumn('description');
            
        });

    }
}
