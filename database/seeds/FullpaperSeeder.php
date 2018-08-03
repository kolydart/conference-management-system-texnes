<?php

use App\Fullpaper;
use App\Paper;
use Illuminate\Database\Seeder;

class FullpaperSeeder extends Seeder
{
	public function __construct(){
       $this->faker = Faker\Factory::create();
       $this->collection = 'finaltext';
       $this->extensions = collect(['doc','pdf','xls','docx']);
	}
	
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $papers = Paper::all();

        foreach ($papers as $paper) {
           // create first
           $this->createMedia($paper);
           // create random more
           for ($i=0; $i < random_int(0,2); $i++) { 
               $this->createMedia($paper);
           }
        }
    }

    public function createMedia($paper){
       $fullpaper = factory(Fullpaper::class)->create(['paper_id'=>$paper->id]);
       
       $filename = $this->faker->word.".".$this->extensions->random();
       File::put($filename, "");
       $media = $fullpaper->addMedia($filename)->usingName($filename)->toMediaCollection($this->collection);
       DB::table('media')->where('id', $media->id)->update(['size' => random_int(30,500)]);
    }

}
