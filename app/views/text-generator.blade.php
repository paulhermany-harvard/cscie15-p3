@extends('layouts.master')

@section('PlaceHolderTitle', 'Lorem Ipsum Text Generator')

@section('PlaceHolderLeadCopy', 'Magna ligula donec mollis massa porttitor ullamcorper risus eu platea fringilla habitasse, suscipit pellentesque donec est habitant vehicula tempor ultrices placerat sociosqu ultrices, consectetur ullamcorper tincidunt quisque tellus ante nostra euismod nec suspendisse.')

@section('PlaceHolderResult', $result)

@section('PlaceHolderMainForm')
	{{ Form::open(
		array(
			'url' => URL::current(),
			'method' => 'POST'
		)
	) }}
		
		<div class="form-group">
			<span>Limit to </span>
			{{ Form::number('textQty', Input::get('textQty'),
				array(
					'min' => '1',
					'max' => '10'
				)
			) }}
			{{ Form::select('textType',
				array(
					'paragraphs' => 'Paragraphs',
					'sentences' => 'Sentences',
					'words' => 'Words'
				), Input::get('textType')
			) }}
		</div>
	
	    <div class="form-group">
			{{ Form::submit('Regenerate',
				array(
					'class' => 'btn btn-primary btn-lg'
				)
			) }}
        </div>
	
	{{ Form::close() }}
	
	<script>
		$(document).ready(function() {
			$('form').submit(function() {
				var textQty = $('input[name="textQty"]').val();
				var textType = $('select[name="textType"]').val();
				$(this).attr('action', '/generate/' + textQty + '/lorem-ipsum/' + textType);
			});
		});
	</script>

@stop
