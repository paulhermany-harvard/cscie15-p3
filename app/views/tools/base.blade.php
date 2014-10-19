@extends('base')

@section('body')
	{{ Form::open(
		array(
			'url' => Route::current()->getUri(),
			'method' => 'POST'
		)
	) }}

		<div class="hd">
			@yield('form-header')
		</div>
		
		<div class="bd">
			@yield('form-body')
		</div>
		
		<div class="ft">
			@section('form-footer')
				<input type="submit" value="Submit"/>
			@show
		</div>
		
	{{ Form::close() }}
@stop