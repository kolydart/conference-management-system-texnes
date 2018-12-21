<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1545398663PapersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('papers', function (Blueprint $table) {
            
if (!Schema::hasColumn('papers', 'description')) {
                $table->text('description')->nullable();
                }
if (!Schema::hasColumn('papers', 'evaluation')) {
                $table->text('evaluation')->nullable();
                }
if (!Schema::hasColumn('papers', 'video')) {
                $table->string('video')->nullable();
                }
if (!Schema::hasColumn('papers', 'bibliography')) {
                $table->text('bibliography')->nullable();
                }
if (!Schema::hasColumn('papers', 'lab_approved')) {
                $table->tinyInteger('lab_approved')->nullable()->default('0');
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
            $table->dropColumn('description');
            $table->dropColumn('evaluation');
            $table->dropColumn('video');
            $table->dropColumn('bibliography');
            $table->dropColumn('lab_approved');
            
        });

    }
}
