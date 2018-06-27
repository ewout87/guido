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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
  
    <style>
          body {
            background-image : url({{url('storage/app/public/background-image.jpg')}});
            background-repeat : no-repeat;
            background-size : cover;
            font-family : Raleway;
          }
          .btn-sm {
            margin : 2px;
          }
          .container-header {
            color : white;
            margin-top : 15px;
          }
          .card {
            margin-bottom : 20px;
          }
          #agenda-item, .btn {
            margin : 2px;
          }
          #hideAlertNoStatusClosed, #hideAlertNoUserAssigned, #hideAlertNoUsersAvailable {
            opacity : 0.5;
          }
          /*
          Make bootstrap-select work with bootstrap 4 see:
          https://github.com/silviomoreto/bootstrap-select/issues/1135
          */
          .dropdown-toggle.btn-default {
            color: #292b2c;
            background-color: #fff;
            border-color: #ccc;
          }

          .bootstrap-select.show>.dropdown-menu>.dropdown-menu {
            display: block;
          }

          .bootstrap-select > .dropdown-menu > .dropdown-menu li.hidden{
            display:none;
          }

          .bootstrap-select > .dropdown-menu > .dropdown-menu li a{
            display: block;
            width: 100%;
            padding: 3px 1.5rem;
            clear: both;
            font-weight: 400;
            color: #292b2c;
            text-align: inherit;
            white-space: nowrap;
            background: 0 0;
            border: 0;
          }

          .dropdown-menu > li.active > a {
            color: #fff !important;
            background-color: #337ab7 !important;
          }

          .bootstrap-select .check-mark::after {
            content: "✓";
          }

          .bootstrap-select button {
            overflow: hidden;
            text-overflow: ellipsis;
          }

          /* Make filled out selects be the same size as empty selects */
          .bootstrap-select.btn-group .dropdown-toggle .filter-option {
            display: inline !important;
          }
          /* The sidebar menu */
          .sidenav a{
              width: 200px; /* Set the width of the sidebar */
              position: absolute; /* Position them relative to the browser window */
              left: -150px; /* Position them outside of the screen */
              transition: 0.3s; /* Add transition on hover */
              text-decoration: none;
              font-size: 20px; /* Increase font size */
              color: white; /* White text color */
              border-radius: 0 5px 5px 0; /* Rounded corners on the top right and bottom right side */
              text-align: left;
          }

          /* When you mouse over the navigation links, change their color */
          .sidenav a:hover {
              left: 0; /* On mouse-over, make the elements appear as they should */
          }
          #dashboard {
              top: 80px;
              background-color: #ff7f50;
          }

          #producten {
              top: 140px;
              background-color: #50d0ff; 
          }

          #gebruikers {
              top: 200px;
              background-color: #7f50ff; 
          }

          #rondleidingen {
              top: 260px;
              background-color: #ffd750; 
          }
          #groepen {
              top: 320px;
              background-color: #ff5079;
          }
          #agenda {
              top: 380px;
              background-color: #50ff7f; 
          }
      
      
          /* Style page content */
          .main {
              margin-left: 200px; /* Same as the width of the sidebar */
          }

           /* The switch - the box around the slider */
          .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
          }

          /* Hide default HTML checkbox */
          .switch input {display:none;}

          /* The slider */
          .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
          }

          .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
          }

          input:checked + .slider {
            background-color: #2196F3;
          }

          input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
          }

          input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
          }

          /* Rounded sliders */
          .slider.round {
            border-radius: 34px;
          }

          .slider.round:before {
            border-radius: 50%;
          } 
          .modal {
            color:black;
          }
     </style>  
</head>
<body>
    <div id="app">
        @include('layouts.navbar')
         <div class="container-fluid">
           @include('layouts.sidebar')
             <div class="main">
                @include('common.errors')
                @yield('content')
             </div>
           @include('layouts.footer')
        </div>
    </div>
    <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-confirmation2/dist/bootstrap-confirmation.min.js"></script>
</body>
</html>
