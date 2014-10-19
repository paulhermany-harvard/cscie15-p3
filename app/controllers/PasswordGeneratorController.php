<?php

class PasswordGeneratorController extends Controller {

	public function generate() {
		return View::make('password-generator');
	}
	
}
