@extends('layouts.master')

@section('PlaceHolderTitle', 'Lorem Ipsum Text Generator')

@section('PlaceHolderLeadCopy', 'Magna ligula donec mollis massa porttitor ullamcorper risus eu platea fringilla habitasse, suscipit pellentesque donec est habitant vehicula tempor ultrices placerat sociosqu ultrices, consectetur ullamcorper tincidunt quisque tellus ante nostra euismod nec suspendisse.')

@section('PlaceHolderResult', isset($result) ? $result : '')

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
					'min' => $textQtyMin,
					'max' => $textQtyMax
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
			<ul class="list-unstyled errors">
			  @foreach($errors->all() as $message)
				<li><p class="text-danger">{{ $message }}</p></li>
			  @endforeach
			</ul>
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
			
			$('select[name="textType"]').change(function() {
				var textType = $(this).val();
				var max;
				switch(textType) {
					case 'paragraphs': max = 10; break;
					case 'sentences': max = 100; break;
					case 'words': max = 1000; break;
				}
				$('input[name="textQty"]').attr('max', max);
			});
		});
	</script>

@stop
