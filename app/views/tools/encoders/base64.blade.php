@extends('tools.base')

@section('title', 'Base64 Encoder/Decoder')


@section('form-header')
	<p>This is how you use the base64 encoder/decoder calculator...</p>
@stop

@section('form-body')
    {{ Form::label('txtDecodedText', 'Decoded Text') }}
    {{ Form::textarea('txtDecodedText') }}
	
	{{ Form::submit('Encode',
		array('onclick' => 'this.form.action = "/base64/encode"'))
	}}
	{{ Form::submit('Decode',
		array('onclick' => 'this.form.action = "/base64/decode"'))
	}}
	
	{{ Input::get('txtEncodedText') }}
	
	{{ Form::label('txtEncodedText', 'Encoded Text') }}
    {{ Form::textarea('txtEncodedText') }}
@stop

@section('form-footer')

@stop