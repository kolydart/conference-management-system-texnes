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
            ['id' => 2, 'alias'=>'home', 'title' => 'Home', 'page_text' => '<div class="row mb-4"> <div class="col-sm-4 my-auto"> <img src="/img/uoa-logo.png" class="img-responsive img-fluid" alt="uoa logo"> </div> <div class="col-sm-8"> <img src="/img/banner.jpg" class="img-responsive img-fluid img-thumbnail" alt="conference logo"> </div> </div> <div class="bs-component mb-5"> <div class="jumbotron"> <h1 class="display-3">Oι Τέχνες στο ελληνικό σχολείο: παρόν και μέλλον</h1> <p class="lead">Συνέδριο 11, 12, 13 Οκτωβρίου 2018</p> <p class="lead">Φιλοσοφική Σχολή</p></p> <hr class="my-4"> <p>Κύριος σκοπός του συνεδρίου είναι η ανάδειξη της κρίσιμης θέσης των τεχνών στον σχεδιασμό της εκπαιδευτικής πολιτικής για το μελλοντικό σχολείο και η παραγωγή εκπαιδευτικού υλικού.</p> <p class="lead"> <a class="btn btn-primary btn-lg mt-3" href="/register" role="button"><i class="fab fa-get-pocket"></i> Θέλω να το παρακολουθήσω</a> </p> </div> </div>', 'excerpt' => 'Sample excerpt', 'featured_image' => '',],

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
