<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Drop5b5cc288ad4225b5cc288a85d6ContentPageContentTagTable extends Migration
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
            $table->foreign('content_page_id', 'fk_p_9395_9394_contenttag_5b5c66ed99251')->references('id')->on('content_pages');
                $table->integer('content_tag_id')->unsigned()->nullable();
            $table->foreign('content_tag_id', 'fk_p_9394_9395_contentpag_5b5c66ed98680')->references('id')->on('content_tags');
                
                $table->timestamps();
                
            });
        }
    }
}
