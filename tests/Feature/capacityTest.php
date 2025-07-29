<?php

namespace Tests\Feature;

use App\Paper;
use App\Room;
use App\Session;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class capacityTest extends TestCase
{

	use \Illuminate\Foundation\Testing\DatabaseTransactions;

	public function createPaper(){
		$this->seed_default_data();
		return Paper::factory()->create(['type'=>'Εργαστήριο','session_id'=>Session::factory()->create()]);
	}

	/** @test */
	public function which_capacity_is_min(){
		$paper = $this->createPaper();

		$paper->session->room->update(['capacity'=>2]);
		$paper->update(['capacity'=>3]);
		$this->assertEquals(2,$paper->capacity());

		$paper->session->room->update(['capacity'=>3]);
		$paper->update(['capacity'=>2]);
		$this->assertEquals(2,$paper->capacity());


	}

	/** @test */
	public function empty_capacity_is_ignored(){
		$paper = $this->createPaper();

		$paper->session->room->update(['capacity'=>2]);
		$paper->update(['capacity'=>'']);
		$this->assertEquals(2,$paper->capacity());

		$paper->session->room->update(['capacity'=>2]);
		$paper->update(['capacity'=>null]);
		$this->assertEquals(2,$paper->capacity());

		$paper->session->room->update(['capacity'=>null]);
		$paper->update(['capacity'=>null]);
		$this->assertEquals(50,$paper->capacity());

		$paper->session->room->update(['capacity'=>""]);
		$paper->update(['capacity'=>null]);
		$this->assertEquals(50,$paper->capacity());

	}



}
