<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1533055500ReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reviews', function (Blueprint $table) {
            if(Schema::hasColumn('reviews', 'judgement')) {
                $table->dropColumn('judgement');
            }
            
        });
Schema::table('reviews', function (Blueprint $table) {
            
if (!Schema::hasColumn('reviews', 'review')) {
                $table->string('review');
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
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropColumn('review');
            
        });
Schema::table('reviews', function (Blueprint $table) {
                        $table->string('judgement')->nullable();
                
        });

    }
}
