<?php

class UserGeneratorController extends Controller {

	public function generate() {
	
		# from doc...
		$faker = Faker\Factory::create();
		
		return View::make('user-generator') -> with(array(
			'name' => $faker->name,
			'address' => $faker->address
		));
	}
	
}
