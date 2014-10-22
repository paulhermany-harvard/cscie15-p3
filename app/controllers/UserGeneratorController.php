<?php

class UserGeneratorController extends Controller {

	public function generate($userQty, $userProperty) {
	
		# from doc...
		$faker = Faker\Factory::create();
		
		$profiles = [];
		
		preg_match('/profile(?=s?)|name(?=s?)|email-address(?=(es)?)|phone-number(?=s?)/', $userProperty, $matches);
		$userProperty = $matches[0];
		
		for ($i = 0; $i < $userQty; $i++) {
		
			$profile = [];
			
			if($userProperty == 'name' || $userProperty == 'profile') {
				$profile['name'] = $faker->name; 
			}
			
			if($userProperty == 'email-address' || $userProperty == 'profile') {
				$profile['email'] = $faker->email;
			}
			
			if($userProperty == 'phone-number' || $userProperty == 'profile') {
				$profile['phone'] = $faker->phonenumber;
			}
		
			array_push($profiles, $profile);
		}
		
		Input::merge(
			array(
				'userQty' => $userQty,
				'userProperty' => $userProperty
			)
		);
		
		return View::make('user-generator') -> with(array(
			'profiles' => $profiles
		));
	}
	
}
