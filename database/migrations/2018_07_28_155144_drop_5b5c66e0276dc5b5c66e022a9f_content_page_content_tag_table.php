<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Drop5b5c66e0276dc5b5c66e022a9fContentPageContentTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('content_page_content_tag');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(! Schema::hasTable('content_page_content_tag')) {
            Schema::create('content_page_content_tag', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('content_page_id')->unsigned()->nullable();
            $table->foreign('content_page_id', 'fk_p_4836_4835_contenttag_5b1a6a8bc9bec')->references('id')->on('content_pages');
                $table->integer('content_tag_id')->unsigned()->nullable();
            $table->foreign('content_tag_id', 'fk_p_4835_4836_contentpag_5b1a6a8bc9294')->references('id')->on('content_tags');
                
                $table->timestamps();
                
            });
        }
    }
}
