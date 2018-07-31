<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1533054380PapersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('papers', function (Blueprint $table) {
            
if (!Schema::hasColumn('papers', 'duration')) {
                $table->string('duration')->nullable();
                }
if (!Schema::hasColumn('papers', 'name')) {
                $table->string('name')->nullable();
                }
if (!Schema::hasColumn('papers', 'email')) {
                $table->string('email')->nullable();
                }
if (!Schema::hasColumn('papers', 'attribute')) {
                $table->string('attribute')->nullable();
                }
if (!Schema::hasColumn('papers', 'status')) {
                $table->string('status');
                }
if (!Schema::hasColumn('papers', 'informed')) {
                $table->string('informed');
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
            $table->dropColumn('duration');
            $table->dropColumn('name');
            $table->dropColumn('email');
            $table->dropColumn('attribute');
            $table->dropColumn('status');
            $table->dropColumn('informed');
            
        });

    }
}
