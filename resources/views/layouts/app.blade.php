<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script> 

    <script src="{{ mix('js/app.js') }}"></script>


    @stack('js')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel='stylesheet' href='https://unpkg.com/@fortawesome/fontawesome-svg-core@1.2.17/styles.css' integrity='sha384-bM49M0p1PhqzW3LfkRUPZncLHInFknBRbB7S0jPGePYM+u7mLTBbwL0Pj/dQ7WqR' crossorigin='anonymous'>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> 

    <link href="{{ asset('css/main.css') }}" rel="stylesheet"> 

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    @stack('css')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome-animation/0.0.10/font-awesome-animation.css" type="text/css" media="all" />

</head>
<body>
    <div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse align-items-center justify-content-between" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    @guest
                        <li class="nav-item">

                            <a class="navbar-brand" href="{{ url('/welcome') }}">
                                Welcome
                            </a>
                        </li>
                        @endif
                </ul>
                    @auth
                        <ul class="navbar-nav mx-auto align-items-center justify-content-between flex-grow-1">
                            <li class="nav-item">
                                <a class="navbar-brand" href="{{ url('/users') }}">
                                    Laravel
                                </a>
                            </li>

                            <li class="dropdown">

                                <button id="navbardown" class="dropbtn" role="button" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </button>

                                <div class="dropdown-content" aria-labelledby="navbardown">
                                    <a class="dropdown-item" href="{{ url('/') }}">
                                        Home
                                    </a>
                                    <a class="dropdown-item" href="{{ url('/users') }}">
                                        Find Friend(s)
                                    </a>
                                    <a class="dropdown-item" href="{{ url('/users/matches') }}">
                                        Matches
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>

                            <!-- <li class="nav-item">
                                <a class="nav-link" href="{{ route('users.matches') }}">
                                    <i class="fa fa-comments fa-2x" aria-hidden="true"></i>
                                </a>
                            </li> -->
                        </ul>
                    @endauth

                    <ul class="navbar-nav ml-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
