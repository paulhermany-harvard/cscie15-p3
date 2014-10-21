<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>@yield('PlaceHolderTitle', 'Developer\'s Best Friend') | CSCI E-15 Fall 2014 | Paul Hermany</title>
    
	{{ HTML::style('css/lib/bootstrap-3.2.0.min.css') }}
    
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

	{{ HTML::script('js/lib/jquery-1.11.1.min.js') }}
	{{ HTML::script('js/lib/bootstrap-3.2.0.min.js') }}
	{{ HTML::script('js/app.js') }}
	
    @yield('PlaceHolderAdditionalPageHead')
  </head>
  <body>
    
	@section('PlaceHolderNavBar') 
    <div class="navbar navbar-inverse navbar-static-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="http://p3.local.paulhermany.me">Developer's Best Friend</a>
            </div>
        </div>
    </div>
    @show
	
	@section('PlaceHolderMain')
    <div class="container">
	
		<div class="jumbotron">
			@yield('PlaceHolderResult')
        </div>
	
		<h1>@yield('PlaceHolderTitle')</h1>
		<p class="lead">@yield('PlaceHolderLeadCopy')</p>
	
		<div class="container">		
			@yield('PlaceHolderMainForm')
		</div>
	
    </div>
	@show
    
  </body>
</html>