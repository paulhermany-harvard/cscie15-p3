<?php

class TextGeneratorController extends Controller {

	/**
	 * Generate random (lorem-ipsum) text using the Faker library
	 *
	 * @param	string	$textQty	The number of instances of the specified type of text to generate. This value has a dynamic maximum constraint based on the selected type.
	 * @param	string	$textSource	The text source (currently limited to lorem-ipsum)
	 * @param	string	$textType	The type of text to generate (paragraph, sentence, word)
	 *
	 * @return	text-generator view
	**/
	public function generate($textQty, $textSource, $textType) {

		// the result will either be null or the randomly generated text
		$result = null;
	
		// merge the route parameters into the input array to set the form values for GET requests
		Input::merge(
			array(
				'textQty' => $textQty,
				'textSource' => $textSource,
				'textType' => $textType
			)
		);
	
		// get the full input array for form validation
		$data = Input::all();

		// set the validation constraints
		//   the constraint for quantity is dynamic based on the selected type,
		//   which is uniquely identified by the first letter
		$constraints = array(
			'p' => 10,	// paragraphs
			's' => 100, // sentences
			'w' => 1000 // words
		);
		
		// set the min/max values for quantity based on selected type
		$textQtyMin = 1;
		$textQtyMax = $constraints[$textType[0]];
		
		// set the validation rules based on the min/max values
		$rules = array(
			'textQty' => array(
				'integer',
				"min:$textQtyMin",
				"max:$textQtyMax"
			)
		);

		// set the validation messages
		$messages = array(
			'textQty.min' => "The number of $textType must be at least $textQtyMin",
			'textQty.max' => "The number of $textType may not be greater than $textQtyMax"
		);
		
		// make the validator
		$validator = Validator::make($data, $rules, $messages);
		
		// validate the form
		if ($validator->passes()) {
		
			// create a new instance of the Faker
			$faker = Faker\Factory::create();

			// generate the random text based on selected type
			switch($textType[0]) {
				case 'p': $result = '<p>'.implode('</p><p>', $faker->paragraphs($textQty)).'</p>'; break;
				case 's': $result = '<p>'.implode(' ', $faker->sentences($textQty)).'</p>'; break;
				case 'w': $result = '<p>'.implode(' ', $faker->words($textQty)).'</p>'; break;
			}
		}
		
		// make the view with result, constraints, and validator
		return View::make('text-generator') -> with(
			array(
				'result' => $result,
				'textQtyMin' => $textQtyMin,
				'textQtyMax' => $textQtyMax,
                'textTypeOptions' => array(
                    'paragraph' => 'paragraph',
                    'sentence' => 'sentence',
                    'word' => 'word'
                )
			)
		) -> withErrors($validator);
	}
	
}
