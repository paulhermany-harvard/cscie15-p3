<?php

class TextGeneratorController extends Controller {

	public function generate($textQty, $textSource, $textType) {
	
		# from the badcow documentation...
		#$generator = new Badcow\LoremIpsum\Generator();
		#implode('<p>', $generator->getParagraphs(1))

		# from doc...
		$faker = Faker\Factory::create();
		
		switch($textType[0]) {
            case 'p': $result = '<p>'.implode('</p><p>', $faker->paragraphs($textQty)).'</p>'; break;
            case 's': $result = '<p>'.implode(' ', $faker->sentences($textQty)).'</p>'; break;
			case 'w': $result = '<p>'.implode(' ', $faker->words($textQty)).'</p>'; break;
        }
		
		return View::make('text-generator') -> with(
			array(
				'result' => $result
			)
		);
	}
	
}
