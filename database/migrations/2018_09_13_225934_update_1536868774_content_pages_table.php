<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1536868774ContentPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('content_pages', function (Blueprint $table) {
            
if (!Schema::hasColumn('content_pages', 'alias')) {
                $table->string('alias')->nullable();
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
        Schema::table('content_pages', function (Blueprint $table) {
            $table->dropColumn('alias');
            
        });

    }
}
