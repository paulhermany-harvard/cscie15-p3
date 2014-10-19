@extends('base')

@section('body')
    <h1>Developer's Best Friend</h1>
    <ul>
		<li>
			<h3>Calculators</h3>
			<ul>
				<li><a href="/calculators/color">Color</a></li>
			</ul>
		</li>
		<li>
			<h3>Encoders/Decoders</h3>
			<ul>
				<li><a href="/encoders/base64">Base64</a></li>
				<li><a href="/encoders/html">HTML</a></li>
				<li><a href="/encoders/url">URL</a></li>
			</ul>
		</li>
		<li>
			<h3>Generators</h3>
			<ul>
				<li><a href="/generators/password">Password</a></li>
				<li><a href="/generators/text">Text</a></li>
				<li><a href="/generators/user">User</a></li>
			</ul>
		</li>
	</ul>
@stop