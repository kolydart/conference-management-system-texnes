<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Drop5b6094903a5b4ContactCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('contact_companies');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(! Schema::hasTable('contact_companies')) {
            Schema::create('contact_companies', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->nullable();
                $table->string('address')->nullable();
                $table->string('website')->nullable();
                $table->string('email')->nullable();
                
                $table->timestamps();
                
            });
        }
    }
}
