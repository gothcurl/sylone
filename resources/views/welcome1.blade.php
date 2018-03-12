
<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="https://use.fontawesome.com/releases/v5.0.7/css/all.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .navbar-brand {
                text-decoration: none;
            }

            .jumbotron {
                background-image: url('images/news-online.jpg');
                background-repeat: no-repeat;
                background-size: 100% 100%;

            }

            
        </style>
    </head>
    <body>
        <div class="navbar-header">
            <nav class="navbar navbar-default navbar-static-top">
        
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a class="fas fa-sign-in-alt" href="{{ route('login') }}"> Login</a>
                        <a class="fas fa-user-plus" href="{{ route('register') }}"> Register</a>
                    @endauth
                </div>
            @endif
                <img src="{{ url('images/sylone-logo.png') }}" class="sylone-logo" alt="sylone" width="50" height="50">
                <b><a class="navbar-brand" href="">SYLONE</a></b> 
            </nav>  
        </div>

        <div class="jumbotron">
            <h1 class="display-4">Hello, world!</h1>
            <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
            <hr class="my-4">
            <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
            <p class="lead">
                <a class="btn btn-primary btn-lg" href="#" role="button">Share us on Facebook</a>
            </p>
        </div>

        <div class="card mb-3">
        
            <img class="card-img-top" src="..." </img> alt="Card image cap">
            <div class="card-block">
                <h4 class="card-title"></h4>
                <p class="card-text"> </p>
                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
            </div>
        
        </div>

    </body>
    
</html>
