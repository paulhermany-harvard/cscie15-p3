<?php

class TextEncoderController extends Controller {

	/**
	 * Encodes text
	 *
	 * @param	string	$encoding	The encoding (base64, html, url)
	 *
	 * @return	text-encoder view
	**/
	public function encode($encoding) {
        
        Input::merge( array('encoding' => $encoding) );

        $decodedText = Input::get('decodedText');
        
        switch($encoding) {
            case 'base64': $encodedText = base64_encode($decodedText); break;
            case 'html': $encodedText = htmlentities($decodedText); break;
            case 'url': $encodedText = urlencode($decodedText); break;
        }
        
        Input::merge( array('encodedText' => htmlentities($encodedText)) );
	
		return View::make('text-encoder');
	}

	/**
	 * Decodes text
	 *
	 * @param	string	$encoding	The encoding (base64, html, url)
	 *
	 * @return	text-encoder view
	**/
	public function decode($encoding) {
        
        Input::merge( array('encoding' => $encoding) );

        $encodedText = Input::get('encodedText');
        
        switch($encoding) {
            case 'base64': $decodedText = base64_decode($encodedText); break;
            case 'html': $decodedText = html_entity_decode($encodedText); break;
            case 'url': $decodedText = urldecode($encodedText); break;
        }
        
        Input::merge(
            array(
                'decodedText' => $decodedText,
                'encodedText' => htmlentities($encodedText)
            )
        );
	
		return View::make('text-encoder');
	}
	
}
