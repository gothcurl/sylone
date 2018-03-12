<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
		<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
       <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>SYLONE</title>

		<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <img src="{{ url('images/sylone-logo.png') }}" class="img-responsive2" alt="sylone" width="50" height="50">	
  <a class="navbar-brand" href="#"><h3>SYLONE</h3></a>
  


	<ul class="nav navbar-nav navbar-right">
  
    	@if (Route::has('login'))
            <div class="top-right links">
            	
                @auth
                    <a href="{{ url('/home') }}">Home</a>
                @else
                    <a  href="{{ route('login') }}"> Login</a>
                    <a  href="{{ route('register') }}"> Register</a>
                @endauth
                
            </div>
       @endif
   </ul>

</nav>	
</body>
</html>