<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1545910555FullpapersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fullpapers', function (Blueprint $table) {
            
            if (!Schema::hasColumn('fullpapers', 'uuid')) {
                $table->string('uuid')->nullable()->unique();
            }
        });
        
        $fullpapers = (new App\Fullpaper())->all();
        foreach ($fullpapers as $fullpaper) {
            $fullpaper->uuid = (string) \Illuminate\Support\Str::uuid();
            if(!$fullpaper->save())
                throw new \Exception("Could not create fullpaper $fullpaper->id => $uuid",500);
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fullpapers', function (Blueprint $table) {
            $table->dropColumn('uuid');
            
        });

    }
}
