<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Drop5b5cc288aa13a5b5cc288a85d6ContentCategoryContentPageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('content_category_content_page');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(! Schema::hasTable('content_category_content_page')) {
            Schema::create('content_category_content_page', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('content_category_id')->unsigned()->nullable();
            $table->foreign('content_category_id', 'fk_p_9393_9395_contentpag_5b5c66ed6f050')->references('id')->on('content_categories');
                $table->integer('content_page_id')->unsigned()->nullable();
            $table->foreign('content_page_id', 'fk_p_9395_9393_contentcat_5b5c66ed6f802')->references('id')->on('content_pages');
                
                $table->timestamps();
                
            });
        }
    }
}
