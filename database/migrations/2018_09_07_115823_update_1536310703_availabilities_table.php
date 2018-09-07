<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1536310703AvailabilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('availabilities', function (Blueprint $table) {
            if(Schema::hasColumn('availabilities', 'notes')) {
                $table->dropColumn('notes');
            }
            
        });
Schema::table('availabilities', function (Blueprint $table) {
            
if (!Schema::hasColumn('availabilities', 'type')) {
                $table->string('type')->nullable();
                }
if (!Schema::hasColumn('availabilities', 'notes')) {
                $table->text('notes')->nullable();
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
        Schema::table('availabilities', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('notes');
            
        });
Schema::table('availabilities', function (Blueprint $table) {
                        $table->string('notes')->nullable();
                
        });

    }
}
