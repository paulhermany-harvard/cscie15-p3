@extends('layouts.master')

@section('PlaceHolderTitle', 'Random User Generator')

@section('PlaceHolderLeadCopy', 'Magna ligula donec mollis massa porttitor ullamcorper risus eu platea fringilla habitasse, suscipit pellentesque donec est habitant vehicula tempor ultrices placerat sociosqu ultrices, consectetur ullamcorper tincidunt quisque tellus ante nostra euismod nec suspendisse.')

@section('PlaceHolderResult')
	@foreach ($profiles as $profile)
		<p class="profile">
			@if (isset($profile['name'])) <span class="name">{{ $profile['name'] }}</span> @endif
			@if (isset($profile['email'])) <span class="email">{{ $profile['email'] }}</span> @endif
			@if (isset($profile['phone'])) <span class="phone">{{ $profile['phone'] }}</span> @endif
		</p>
	@endforeach
@stop

@section('PlaceHolderMainForm')
	{{ Form::open(
		array(
			'url' => URL::current(),
			'method' => 'POST'
		)
	) }}
		
		<div class="form-group">
			<span>Limit to </span>
			{{ Form::number('userQty', Input::get('userQty'),
				array(
					'min' => '1',
					'max' => '10'
				)
			) }}
			<span>user</span>
			{{ Form::select('userProperty',
				array(
					'profile' => 'Profiles',
					'name' => 'Names',
					'email-address' => 'Email Addresses',
					'phone-number' => 'Phone Numbers'
				), Input::get('userProperty')
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
				var userQty = $('input[name="userQty"]').val();
				var userProperty = $('select[name="userProperty"]').val();
				$(this).attr('action', '/generate/' + userQty + '/user/' + userProperty);
			});
		});
	</script>

@stop
