<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LogsActivityPropertiesLongtext extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {        
        DB::statement('ALTER TABLE '.\Config::get('database.connections.mysql.prefix').(new \App\Activitylog)->getTable().' CHANGE properties properties LONGTEXT;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE '.\Config::get('database.connections.mysql.prefix').(new \App\Activitylog)->getTable().' CHANGE properties properties TEXT;');
    }
}
