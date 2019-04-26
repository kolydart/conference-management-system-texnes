<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserAttributeText extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE '.\Config::get('database.connections.mysql.prefix').(new \App\User)->getTable().' CHANGE `attribute` `attribute` TEXT;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE '.\Config::get('database.connections.mysql.prefix').(new \App\User)->getTable().' CHANGE `attribute` `attribute` varchar(191);');
    }
}
