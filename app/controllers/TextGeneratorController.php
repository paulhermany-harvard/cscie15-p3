<?php

class TextGeneratorController extends Controller {

	public function generate() {
	
		# from the badcow documentation...
		$generator = new Badcow\LoremIpsum\Generator();

		return View::make('text-generator') -> with(array('result' => implode('<p>', $generator->getParagraphs(1))));
	}
	
}
