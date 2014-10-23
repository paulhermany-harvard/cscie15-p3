<?php

class UserGeneratorController extends Controller {

	/**
	 * Generate random user using the Faker library
	 *
	 * @param	string	$userQty		The number of users to generate.
     * @param   string  $userType       The type of user to generate (user, users)
	 * @param	string	$userProperty	The property of the user to generate (profile, name, email, phone, photo)
	 *
	 * @return	user-generator view
	**/
	public function generate($userQty, $userType, $userProperty) {
	
		// the result will either be an empty array or a collection of user "profiles"
		$profiles = [];
	
		// merge the route parameters into the input array to set the form values for GET requests
		Input::merge(
			array(
				'userQty' => $userQty,
				'userProperty' => $userProperty
			)
		);
    
		// get the full input array for form validation
		$data = Input::all();
		
		// set the min/max values for quantity
		$userQtyMin = 1;
		$userQtyMax = 10;
		
		// set the validation rules based on the min/max values
		$rules = array(
			'userQty' => array(
				'integer',
				"min:$userQtyMin",
				"max:$userQtyMax"
			)
		);

		// set the validation messages
		$messages = array(
			'userQty.min' => "The number of users must be at least $userQtyMin",
			'userQty.max' => "The number of users may not be greater than $userQtyMax"
		);
		
		// make the validator
		$validator = Validator::make($data, $rules, $messages);
	
		// validate the form
		if ($validator->passes()) {
			
			// create a new instance of the Faker
			$faker = Faker\Factory::create();
			
			// use regex with non-capturing lookahead assertion to get the user property
			preg_match('/profile(?=s?)|name(?=s?)|email-address(?=(es)?)|phone-number(?=s?)|photo(?=s?)/', $userProperty, $matches);
			$userProperty = $matches[0];
			
			// loop through the specified number of profiles and generate the properties
			//   the "profile" property will contain all user properties
			for ($i = 0; $i < $userQty; $i++) {
			
				$profile = [];
				
				// include the name property
				if($userProperty == 'name' || $userProperty == 'profile') {
					$profile['name'] = $faker->name; 
				}

				// include the email address property
				if($userProperty == 'email-address' || $userProperty == 'profile') {
					$profile['email'] = $faker->email;
				}
				
				// include the phone number property
				if($userProperty == 'phone-number' || $userProperty == 'profile') {
					$profile['phone'] = $faker->phonenumber;
				}
				
				// include the photo property
				if($userProperty == 'photo' || $userProperty == 'profile') {
					// since the photo is generated using an ajax request to a third-party api,
					//   all we need here is a placeholder string so the value is not null
					$profile['photo'] = '';
				}
				
				// add the profile to the list of profiles
				array_push($profiles, $profile);
			}
            
            // merge the singular user property back to the input array so the form will be loaded for plural routes
            Input::merge( array('userProperty' => $userProperty) );
        }
        
		// make the view with profiles, constraints, and validator
		return View::make('user-generator') -> with(
			array(
				'profiles' => $profiles,
				'userQtyMin' => $userQtyMin,
				'userQtyMax' => $userQtyMax,
                'userPropertyOptions' => array(
                    'profile' => 'profile',
                    'name' => 'name',
                    'email-address' => 'email address',
                    'phone-number' => 'phone number',
                    'photo' => 'photo'
                )
			)
		) -> withErrors($validator);
	}
	
}
