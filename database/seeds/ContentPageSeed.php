<?php

use App\ContentCategory;
use App\ContentPage;
use App\ContentTag;
use Illuminate\Database\Seeder;

class ContentPageSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'alias'=>'about', 'title' => 'About us', 'page_text' => 'Sample text', 'excerpt' => 'Sample excerpt', 'featured_image' => '',],
            ['id' => 2, 'alias'=>'home', 'title' => 'Home', 'page_text' => '
<div class="row mb-4">
    <div class="col-sm-4 my-auto"> <img src="/img/uoa-logo.png" class="img-responsive img-fluid" alt="uoa logo"> </div>
    <div class="col-sm-8"> <img src="/img/banner.jpg" class="img-responsive img-fluid img-thumbnail" alt="conference logo"> </div>
</div>
<div class="bs-component mb-5">
    <div class="jumbotron">
        <h1 class="display-3">Επίδειξη εφαρμογής Συστήματος Διαχείρισης Συνεδρίων</h1>
        <p class="lead">Demo application of the Conference Management System</p>
        <p class="lead">Conference venue</p>
        </p>
        <hr class="my-4">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    </div>
</div>
            ', 'excerpt' => 'Sample excerpt', 'featured_image' => '',],

        ];

        foreach ($items as $item) {
            \App\ContentPage::create($item);
        }

        factory(ContentPage::class,40)->create()->each(function($page){
            $page->category_id()->save(ContentCategory::all()->random());
            $page->tag_id()->saveMany(ContentTag::all()->random(3));
        });
    }
}
