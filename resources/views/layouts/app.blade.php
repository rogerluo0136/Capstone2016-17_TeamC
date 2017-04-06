<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Holland Bloorview Music & Arts</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700" rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Lobster+Two' rel='stylesheet' type='text/css'>
    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"> 
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    
    <link href="/css/home.css" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!--  popup fix uncomment  --> <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> --> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    

    @yield('script')

    <!-- CSS -->
    @yield('css')

    <style>
        body {
            font-family: 'Verdana';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
    <div id="body-filter"></div>
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                @if (Auth::guest())
                <a class="navbar-brand" href="{{ url('/')}}">
                    <img src="\images\HBKlogo.png" alt="Holland Bloorview Kids Rehabilation Hospital" style="width:200px;height:20px;" />
                </a>
                @else
                <a class="navbar-brand" href="{{ URL::action('HomeController@index') }}">
                    <img src="\images\HBKlogo.png" alt="Holland Bloorview Kids Rehabilation Hospital" style="width:200px;height:20px;" />
                </a>
                @endif
                
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/home') }}">Home</a></li>
                    
                    @if(!Auth::guest() && Auth::user()->type=='admin')
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Season <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ URL::action('SeasonController@create') }}">Create</a></li>
                                <li><a href="{{ URL::action('SeasonController@index') }}">View</a></li>
                                <li><a href="{{ URL::action('SeasonController@exportData') }}">Export</a></li>
                            </ul>
                        </li>
                        
                        
                        
                        <li >
                            <a href="#" type="button" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Program <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li role="presentation"><a role="menuitem" href="{{ URL::action('ProgramController@create') }}">Create</a></li>
                                <li role="presentation"><a role="menuitem" href="{{ URL::action('ProgramController@index') }}">View</a></li>
                            </ul>
                        </li>
                        
                        
                        
                        
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Transaction <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ URL::action('TransactionController@create')}}">Add</a></li>
                                <li><a href="{{ URL::action('TransactionController@index')}}">Export</a></li>
                            </ul>
                        </li>




                    @endif
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Sign Up</a></li>
                    @else
                        <li><a href="{{ url('/home') }}">User: {{ Auth::user()->username }}</a></li>
                        {{-- <li>
                            <a href="{{ url('/logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                <i class="glyphicon glyphicon-off"></i>
                            </a>

                            <form id="logout-form" action="{{  url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li> --}}
                         <li>
                            <a href="{{ url('/logout') }}">
                                <i class="glyphicon glyphicon-off"></i> Log out
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-4">
                    <h4><b><a href="#">Contact</a></b></h4>
                    <span class="glyphicon glyphicon-user"></span> Name:John Doe <br>
                    <span class="glyphicon glyphicon-envelope"></span> Email:admin@example.com <br>
                    <span class="glyphicon glyphicon-phone-alt"></span> Tel: 123456798 <br>
                </div>
                
                <div class="col-xs-12 col-md-4">
                    <h4><b><a href="#">Privacy Policy</a></b></h4>
                </div>
                
                <div class="col-xs-12 col-md-4">
                    <h4><b><a href="#">About Us</a></b></h4>
                </div>
                
            </div>
        </div>
        
    </footer>
    
    <!-- JavaScripts -->


    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    <script>
        $(document).ready(function(){
            $('[data-toggle="popover"]').popover();   
        });
    </script>

    @yield('js')
</body>
</html>
