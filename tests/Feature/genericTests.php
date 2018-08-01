<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use gateweb\common\Presenter;
use gateweb\common\Router;

class genericTests extends TestCase
{

	/** @test */
	public function gateweb_class_is_loaded(){
		$this->assertTrue(class_exists(Presenter::class));
		$this->assertTrue(class_exists(Router::class));
	}


	/** @test */
	public function seeds_exist(){
		$this->assertTrue(class_exists(\UserActionSeed::class));
	}

	

}
