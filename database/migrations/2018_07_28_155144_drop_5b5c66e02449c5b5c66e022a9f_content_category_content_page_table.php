<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Drop5b5c66e02449c5b5c66e022a9fContentCategoryContentPageTable extends Migration
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
            $table->foreign('content_category_id', 'fk_p_4834_4836_contentpag_5b1a6a8bb67fb')->references('id')->on('content_categories');
                $table->integer('content_page_id')->unsigned()->nullable();
            $table->foreign('content_page_id', 'fk_p_4836_4834_contentcat_5b1a6a8bb7149')->references('id')->on('content_pages');
                
                $table->timestamps();
                
            });
        }
    }
}
