<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Guido') }}</title>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
      
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
  
     <style>
            html, body {
                background-image: url('storage/app/public/login.jpg');
                background-repeat: no-repeat;
                background-size: cover;
                font-family: Raleway;
            }        
            .sidenav {
                height: 100%; /* Full-height: remove this if you want "auto" height */
                width: 350px; /* Set the width of the sidebar */
                position: fixed; /* Fixed Sidebar (stay in place on scroll) */
                z-index: 1; /* Stay on top */
                top: 0; /* Stay at the top */
                right: 0;
                background-color: dark; /* Black */
                overflow-x: hidden; /* Disable horizontal scroll */
                padding-top: 20px;
                padding-right: 20px
            }
            .main {
              margin-right: 350px; /* Same as the width of the sidebar */
              
            }
            .title {
                font-size: 84px;
                font-family: 'Raleway', sans-serif;
                color: white;
                padding-left: 20px;
            }
            .slogan {
                font-size: 30px;
                font-family: 'Raleway', sans-serif;
                color: white;
                padding-left: 20px;
            }
        </style>
</head>
  <body>
    <div>
      <main>
        <div class="title">
          Guido.
        </div>
        <div class="slogan">
         Follow the guide
        </div>
      </main>
      <nav class="sidenav">
            @if (Route::has('login'))
              <div class="button-group text-right">
                @auth
                  <a class="btn btn-outline-light" href="{{ url('/dashboard') }}">Home</a>
                @else
                  <a class="btn btn-outline-light" href="{{ route('login') }}">{{ __('Login') }}</a>
                  <a class="btn btn-outline-light" href="{{ route('register') }}">{{ __('Register') }}</a>
                @endauth
              </div>
            @endif
          <br>
          <div>
            @yield('content')
          </div>
      </nav>
    </div>
  </body>
</html>