<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMediaTableForSpatieV9 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('media', function (Blueprint $table) {
            $table->string('conversions_disk')->nullable()->after('disk');
            $table->uuid('uuid')->nullable()->unique()->after('model_type');
            $table->json('generated_conversions')->after('custom_properties');
            $table->json('responsive_images')->after('generated_conversions');
            
            // Change text columns to json
            $table->json('manipulations')->change();
            $table->json('custom_properties')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('media', function (Blueprint $table) {
            $table->dropColumn(['conversions_disk', 'uuid', 'generated_conversions', 'responsive_images']);
        });
    }
}
