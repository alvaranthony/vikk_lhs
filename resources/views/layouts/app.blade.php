<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom_navbar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom_body.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top navbar-custom">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/home') }}">
                        <img src="{{URL::asset('/images/vikklogohall.png')}}" alt="logo" height="60" width="650">
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}" style="color:white;">Sisene</a></li>
                            <li><a href="{{ route('register') }}" style="color:white;">Registreeri</a></li>
                        @else
                            <li>
                                <a style="color:white; padding:5% 0 5% 0;">
                                    Tere tulemast {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                                </a>
                                <ul>
                                    <li>
                                        <a href="{{ route('logout') }}" style="color:white; float:right; background-color:#79181A; border-radius:5px; padding:2px; margin-left:10px;"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logi välja
                                        </a>
                                        <a href="/myprofile" class="material-icons pull-right">account_circle</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                                
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @if (!Auth::guest())
            @if(!(count(Auth::user()->role) < 2 && Auth::user()->hasRole('Vaikimisi')))
            <nav class="navbar navbar-default navbar-static-top  navbar-custom-secondary">
                <ul class="nav navbar-nav">
                    @if (Auth::user()->hasRole('Õpilane'))
                         @if (Auth::user()->thesis()->where('role_id', 1)->exists() === false);
                             <li>
                                <a href="/theses/create">
                                    Sisesta lõputöö andmed
                                </a>
                            </li>
                        @endif
                        <li>
                            <a href="/internships/create">
                                Sisesta praktika andmed
                            </a>
                        </li>
                    @endif
                    @if (Auth::user()->hasRole('Õpetaja'))
                        <li>
                            <a href="/theses">
                                Lõputööde andmed
                            </a>
                        </li>
                        <li>
                            <a href="/internships">
                                Praktikate andmed
                            </a>
                        </li>
                    @endif
                    @if (Auth::user()->hasRole('Juhendaja'))
                        <li>
                            <a href="/instructor/theses">
                                Juhendatavad lõputööd
                            </a>
                        </li>
                    @endif
                    @if (Auth::user()->hasRole('Retsensent'))
                        <li>
                            <a href="/reviewer/theses">
                                Retsenseeritavad lõputööd
                            </a>
                        </li>
                    @endif
                    @if (Auth::user()->hasRole('Administraator'))
                        <li>
                            <a href="/users">
                                Halda kasutajaid
                            </a>
                        </li>
                        <li>
                            <a href="/groups">
                                Halda õppegruppe
                            </a>
                        </li>
                        <li>
                            <a href="/theses">
                                Kuva lõputööd
                            </a>
                        </li>
                    @endif
                </ul>
            </nav>
            @endif
        @endif
        @yield('content')
    </div>
    
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    
    <script>
        /* global $*/
        $(function() {
            $( ".datepicker-cls" ).datepicker({
                dateFormat: 'yy-mm-dd'
            });
        });
    </script>
</body>
</html>
