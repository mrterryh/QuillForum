<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>@yield('title') | Quill Forum</title>
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/sweetalert.css') }}">
        <meta id="token" value="{{ csrf_token() }}">
    </head>

    <body>
        <nav class="navbar navbar-dark bg-primary navbar-full">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">Quill</a>
               
                <ul class="nav navbar-nav">
                    <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('home') }}">
                            <i class="fa fa-home"></i> Home
                        </a>
                    </li>
                </ul>

                <ul class="nav navbar-nav pull-xs-right">
                    @if (auth()->check())
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa fa-bell"></i> Notifications
                            </a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                <img class="nav-avatar" src="{{ auth()->user()->avatar(21) }}" alt="My Profile Image"> Me
                            </a>
                            
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('auth::logout') }}">Log out</a>
                            </div>
                        </li>
                    @else
                        <li class="nav-item {{ Request::is('login') ? 'active' : '' }}">
                            <a href="{{ route('auth::login') }}" class="nav-link">
                                <i class="fa fa-user"></i> Sign in
                            </a>
                        </li>

                        <li class="nav-item {{ Request::is('register') ? 'active' : '' }}">
                            <a href="{{ route('auth::register') }}" class="nav-link">
                                <i class="fa fa-plus"></i> Create account
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </nav>

        <div class="container container-main">
            @if (Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif

            @if (auth()->user() && ! auth()->user()->isActivated())
                <div class="alert alert-warning">
                    Your account is not yet activated. Check your inbox and click the activation
                    link we sent to unlock extra website features!
                </div>
            @endif

            @yield('content')
        </div>

        <div class="container">
            <hr>

            <p class="text-muted pull-xs-left">Copyright &copy; 2016 <a href="{{ route('home') }}">Quill</a></p>
            <p class="text-muted pull-xs-right">Powered by <a href="#">Quill Forum</a></p>
        </div>

        <script>
            // @TODO Extract to method, e.g. Quill::getScriptVariables();
            window.Quill = {
                userLoggedIn: {{ auth()->check() ? 1 : 0 }},
                user: {!! auth()->check() ? auth()->user() : '{}' !!}
            };
        </script>

        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    </body>
</html>