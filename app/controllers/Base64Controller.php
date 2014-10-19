<?php

class Base64Controller extends BaseController {

	public function encode() {
		Input::merge(array('txtEncodedText'=>'encoded!'));
		Input::flash();
		return View::make('tools.encoders.base64');
	}

	public function decode() {
		return View::make('tools.encoders.base64');
	}
	
}
